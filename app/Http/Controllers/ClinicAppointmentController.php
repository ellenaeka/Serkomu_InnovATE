<?php

namespace App\Http\Controllers;

use App\Models\ClinicAppointment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ClinicAppointmentController extends Controller
{
    private const LOCATION = 'Klinik Telkomedika Telkom University, Bandung, Jawa Barat';

    private const CAPACITY = 1;

    private const TIMEZONE = 'Asia/Jakarta';

    /**
     * Memastikan pengguna adalah mahasiswa.
     */
    private function authorizeMahasiswa(): void
    {
        abort_unless(
            auth()->check() && auth()->user()->role === 'mahasiswa',
            403,
            'Akses hanya untuk mahasiswa.'
        );
    }

    /**
     * Durasi setiap layanan.
     */
    private function getDuration(string $poli): int
    {
        return match ($poli) {
            'Poli Umum' => 10,
            'Poli Gigi' => 30,
            'Konseling/Mental' => 60,
            default => 10,
        };
    }

    /**
     * Membuat pilihan jam berdasarkan durasi layanan.
     */
    private function generateTimeSlots(string $poli): array
    {
        $duration = $this->getDuration($poli);

        $start = Carbon::createFromTime(8, 0, 0, self::TIMEZONE);
        $end = Carbon::createFromTime(16, 0, 0, self::TIMEZONE);

        $slots = [];

        while ($start->copy()->addMinutes($duration)->lte($end)) {
            $slots[] = $start->format('H:i');
            $start->addMinutes($duration);
        }

        return $slots;
    }

    /**
     * DASHBOARD KLINIK MAHASISWA.
     */
    public function index()
    {
        $this->authorizeMahasiswa();

        $userId = auth()->id();

        $kunjunganQuery = ClinicAppointment::where('user_id', $userId);

        $totalMendatang = (clone $kunjunganQuery)
            ->whereNotIn('status', ['Selesai', 'Dibatalkan'])
            ->count();

        $totalRiwayat = (clone $kunjunganQuery)
            ->whereIn('status', ['Selesai', 'Dibatalkan'])
            ->count();

        $kunjunganMendatang = (clone $kunjunganQuery)
            ->whereNotIn('status', ['Selesai', 'Dibatalkan'])
            ->orderBy('tanggal')
            ->orderBy('jam')
            ->orderBy('queue_number')
            ->limit(3)
            ->get();

        $riwayatKlinik = (clone $kunjunganQuery)
            ->whereIn('status', ['Selesai', 'Dibatalkan'])
            ->orderByDesc('tanggal')
            ->orderByDesc('created_at')
            ->limit(3)
            ->get();

        return view('mahasiswa.klinik', compact(
            'kunjunganMendatang',
            'riwayatKlinik',
            'totalMendatang',
            'totalRiwayat'
        ));
    }

    /**
     * FORM PENDAFTARAN.
     */
    public function create()
    {
        $this->authorizeMahasiswa();

        return view('mahasiswa.klinik.create', [
            'lokasiKlinik' => self::LOCATION,
        ]);
    }

    /**
     * CEK KETERSEDIAAN JADWAL.
     */
    public function availability(Request $request)
    {
        $this->authorizeMahasiswa();

        $validated = $request->validate([
            'poli' => 'required|in:Poli Umum,Poli Gigi,Konseling/Mental',
            'tanggal' => 'required|date|after_or_equal:today',
        ]);

        $poli = $validated['poli'];
        $tanggal = $validated['tanggal'];

        $bookedCounts = ClinicAppointment::query()
            ->where('poli', $poli)
            ->whereDate('tanggal', $tanggal)
            ->where('status', '!=', 'Dibatalkan')
            ->get()
            ->groupBy(function ($item) {
                return Carbon::parse($item->jam)->format('H:i');
            })
            ->map(fn ($items) => $items->count());

        $myBookings = ClinicAppointment::query()
            ->where('user_id', auth()->id())
            ->whereDate('tanggal', $tanggal)
            ->where('status', '!=', 'Dibatalkan')
            ->pluck('jam')
            ->map(fn ($jam) => Carbon::parse($jam)->format('H:i'))
            ->toArray();

        $slots = [];

        foreach ($this->generateTimeSlots($poli) as $jam) {
            $total = (int) ($bookedCounts[$jam] ?? 0);

            $alreadyBooked = in_array($jam, $myBookings, true);

            $pastTime = $tanggal === now(self::TIMEZONE)->toDateString()
                && $jam <= now(self::TIMEZONE)->format('H:i');

            $full = $total >= self::CAPACITY;

            $slots[$jam] = [
                'booked' => $total,
                'remaining' => max(0, self::CAPACITY - $total),
                'full' => $full,
                'already_booked' => $alreadyBooked,
                'available' => !$full && !$alreadyBooked && !$pastTime,
            ];
        }

        return response()->json([
            'success' => true,
            'slots' => $slots,
        ]);
    }

    /**
     * MENYIMPAN DRAFT PENDAFTARAN.
     */
    public function store(Request $request)
    {
        $this->authorizeMahasiswa();

        $validated = $request->validate([
            'poli' => 'required|in:Poli Umum,Poli Gigi,Konseling/Mental',
            'tanggal' => 'required|date|after_or_equal:today',
            'jam' => 'required|date_format:H:i',
            'keluhan' => 'nullable|string|max:1000',
        ]);

        if (!in_array(
            $validated['jam'],
            $this->generateTimeSlots($validated['poli']),
            true
        )) {
            throw ValidationException::withMessages([
                'jam' => 'Jam tidak sesuai dengan interval layanan yang dipilih.',
            ]);
        }

        if (
            $validated['tanggal'] === now(self::TIMEZONE)->toDateString()
            && $validated['jam'] <= now(self::TIMEZONE)->format('H:i')
        ) {
            throw ValidationException::withMessages([
                'jam' => 'Jam kunjungan tersebut sudah terlewat.',
            ]);
        }

        $alreadyBooked = ClinicAppointment::where('user_id', auth()->id())
            ->whereDate('tanggal', $validated['tanggal'])
            ->whereTime('jam', $validated['jam'])
            ->where('status', '!=', 'Dibatalkan')
            ->exists();

        if ($alreadyBooked) {
            throw ValidationException::withMessages([
                'jam' => 'Kamu sudah memiliki kunjungan pada tanggal dan jam tersebut.',
            ]);
        }

        $totalBooked = ClinicAppointment::where('poli', $validated['poli'])
            ->whereDate('tanggal', $validated['tanggal'])
            ->whereTime('jam', $validated['jam'])
            ->where('status', '!=', 'Dibatalkan')
            ->count();

        if ($totalBooked >= self::CAPACITY) {
            throw ValidationException::withMessages([
                'jam' => 'Sesi sudah terisi. Silakan pilih jadwal lain.',
            ]);
        }

        session([
            'clinic_appointment_draft' => $validated,
        ]);

        return redirect()->route('mahasiswa.klinik.confirmation');
    }

    /**
     * HALAMAN KONFIRMASI.
     */
    public function confirmation()
    {
        $this->authorizeMahasiswa();

        $draft = session('clinic_appointment_draft');

        if (!$draft) {
            return redirect()
                ->route('mahasiswa.klinik.create')
                ->with('error', 'Silakan isi formulir pendaftaran terlebih dahulu.');
        }

        return view('mahasiswa.klinik.confirmation', [
            'draft' => $draft,
            'mahasiswa' => auth()->user(),
            'durasiMenit' => $this->getDuration($draft['poli']),
            'lokasiKlinik' => self::LOCATION,
        ]);
    }

    /**
     * KONFIRMASI DAN PENYIMPANAN ANTREAN PERMANEN.
     */
    public function confirm(Request $request)
    {
        $this->authorizeMahasiswa();

        $draft = session('clinic_appointment_draft');

        if (!$draft) {
            return redirect()
                ->route('mahasiswa.klinik.create')
                ->with('error', 'Data pendaftaran tidak ditemukan.');
        }

        $request->validate([
            'persetujuan' => 'required|accepted',
        ], [
            'persetujuan.accepted' => 'Kamu harus menyetujui data pendaftaran terlebih dahulu.',
        ]);

        $tanggal = Carbon::parse($draft['tanggal'])->toDateString();
        $jam = $draft['jam'];
        $poli = $draft['poli'];
        $userId = auth()->id();

        $appointment = DB::transaction(function () use (
            $tanggal,
            $jam,
            $poli,
            $userId,
            $draft
        ) {
            /*
             * Kunci antrean berdasarkan tanggal dan poli.
             * Semua pendaftaran pada tanggal dan poli yang sama
             * akan diproses secara berurutan.
             */

            DB::table('clinic_queue_counters')->insertOrIgnore([
                'tanggal' => $tanggal,
                'poli' => $poli,
                'last_number' => 0,
                'created_at' => now(self::TIMEZONE),
                'updated_at' => now(self::TIMEZONE),
            ]);

            $counter = DB::table('clinic_queue_counters')
                ->where('tanggal', $tanggal)
                ->where('poli', $poli)
                ->lockForUpdate()
                ->first();

            if (!$counter) {
                throw new \RuntimeException('Data penghitung antrean tidak ditemukan.');
            }

            /*
             * Cek ulang kapasitas slot di dalam transaksi.
             */
            $totalBooked = ClinicAppointment::where('poli', $poli)
                ->whereDate('tanggal', $tanggal)
                ->whereTime('jam', $jam)
                ->where('status', '!=', 'Dibatalkan')
                ->count();

            if ($totalBooked >= self::CAPACITY) {
                throw ValidationException::withMessages([
                    'jam' => 'Maaf, sesi sudah terisi. Silakan pilih jadwal lain.',
                ]);
            }

            /*
             * Cegah mahasiswa melakukan booking ganda.
             */
            $doubleBooking = ClinicAppointment::where('user_id', $userId)
                ->whereDate('tanggal', $tanggal)
                ->whereTime('jam', $jam)
                ->where('status', '!=', 'Dibatalkan')
                ->exists();

            if ($doubleBooking) {
                throw ValidationException::withMessages([
                    'jam' => 'Kamu sudah memiliki kunjungan pada tanggal dan jam tersebut.',
                ]);
            }

            /*
             * Nomor antrean berdasarkan urutan konfirmasi.
             * Semua status termasuk Dibatalkan tetap dihitung
             * melalui counter yang tidak pernah dikurangi.
             */
            $queueNumber = (int) $counter->last_number + 1;

            DB::table('clinic_queue_counters')
                ->where('id', $counter->id)
                ->update([
                    'last_number' => $queueNumber,
                    'updated_at' => now(self::TIMEZONE),
                ]);

            /*
             * Buat kode registrasi unik.
             */
            do {
                $bookingCode = 'KLINIK-' . strtoupper(Str::random(8));
            } while (
                ClinicAppointment::where('booking_code', $bookingCode)->exists()
            );

            /*
             * Jam panggilan tetap mengikuti jam yang dipilih pasien.
             * Nomor antrean tidak mengubah jam kunjungan.
             */
            $estimatedCallTime = Carbon::parse(
                $tanggal . ' ' . $jam,
                self::TIMEZONE
            )->format('H:i:s');

            return ClinicAppointment::create([
                'user_id' => $userId,
                'booking_code' => $bookingCode,
                'queue_number' => $queueNumber,
                'estimated_call_time' => $estimatedCallTime,
                'poli' => $poli,
                'tanggal' => $tanggal,
                'jam' => $jam,
                'keluhan' => $draft['keluhan'] ?? null,
                'status' => 'Menunggu',
            ]);
        }, 3);

        session()->forget('clinic_appointment_draft');

        return redirect()
            ->route('mahasiswa.klinik.bukti', $appointment->id)
            ->with('success', 'Pendaftaran klinik berhasil dikonfirmasi.');
    }

    /**
     * BUKTI PENDAFTARAN.
     *
     * Nomor dibaca langsung dari database.
     * Tidak ada penghitungan ulang.
     */
    public function proof($id)
    {
        $this->authorizeMahasiswa();

        $appointment = ClinicAppointment::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $nomorAntrean = 'A-' . str_pad(
            $appointment->queue_number,
            2,
            '0',
            STR_PAD_LEFT
        );

        $durasiMenit = $this->getDuration($appointment->poli);

        $estimasiPanggil = $appointment->estimated_call_time
            ? Carbon::parse($appointment->estimated_call_time)->format('H:i') . ' WIB'
            : '-';

        return view('mahasiswa.klinik.bukti', compact(
            'appointment',
            'nomorAntrean',
            'durasiMenit',
            'estimasiPanggil'
        ) + [
            'lokasiKlinik' => self::LOCATION,
        ]);
    }

    /**
     * FORM PEMBATALAN.
     */
    public function cancelForm($id)
    {
        $this->authorizeMahasiswa();

        $appointment = ClinicAppointment::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        abort_if(
            in_array($appointment->status, ['Selesai', 'Dibatalkan']),
            403,
            'Kunjungan ini tidak dapat dibatalkan.'
        );

        return view('mahasiswa.klinik.batalkan', compact('appointment'));
    }

    /**
     * PROSES PEMBATALAN.
     */
    public function cancel(Request $request, $id)
    {
        $this->authorizeMahasiswa();

        $reason = $request->input(
            'cancellation_reason',
            $request->input('alasan')
        );

        $request->merge([
            'cancellation_reason' => $reason,
        ]);

        $validated = $request->validate([
            'cancellation_reason' => 'required|string|max:500',
        ], [
            'cancellation_reason.required' => 'Silakan pilih alasan pembatalan.',
        ]);

        DB::transaction(function () use ($id, $validated) {
            $appointment = ClinicAppointment::where('id', $id)
                ->where('user_id', auth()->id())
                ->lockForUpdate()
                ->firstOrFail();

            if (in_array($appointment->status, ['Selesai', 'Dibatalkan'])) {
                throw ValidationException::withMessages([
                    'cancellation_reason' => 'Kunjungan sudah tidak dapat dibatalkan.',
                ]);
            }

            $appointment->update([
                'status' => 'Dibatalkan',
                'cancellation_reason' => $validated['cancellation_reason'],
            ]);

            /*
             * Counter antrean sengaja tidak dikurangi.
             * Nomor yang sudah diterbitkan tidak digunakan kembali.
             * Slot kunjungan yang dibatalkan otomatis tersedia kembali.
             */
        });

        return redirect()
            ->route('mahasiswa.klinik')
            ->with('success', 'Kunjungan berhasil dibatalkan. Nomor antrean tetap tersimpan dan jadwal tersedia kembali.');
    }

    /**
     * RIWAYAT SELURUH KUNJUNGAN.
     */
    public function history()
    {
        $this->authorizeMahasiswa();

        $riwayat = ClinicAppointment::where('user_id', auth()->id())
            ->orderByDesc('tanggal')
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('mahasiswa.klinik-riwayat', compact('riwayat'));
    }
}
