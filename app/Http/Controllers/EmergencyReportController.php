<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\EmergencyReport;

class EmergencyReportController extends Controller
{
    // ==========================================
    // OTORISASI PENGGUNA
    // ==========================================

    private function authorizeMahasiswa()
    {
        abort_unless(
            auth()->check() && auth()->user()->role === 'mahasiswa',
            403,
            'Akses hanya untuk mahasiswa.'
        );
    }

    private function authorizePetugas()
    {
        abort_unless(
            auth()->check() && auth()->user()->role === 'petugas',
            403,
            'Akses hanya untuk petugas.'
        );
    }

    // ==========================================
    // HALAMAN UTAMA LAPOR MAHASISWA
    // ==========================================

    public function create()
    {
        $this->authorizeMahasiswa();

        $laporanSaya = EmergencyReport::where(
            'user_id',
            auth()->id()
        )
            ->latest()
            ->get();

        $laporanDicari = null;

        // Menampilkan kembali laporan yang baru dikirim
        if (session()->has('tracking_code')) {
            $laporanDicari = EmergencyReport::where(
                'tracking_code',
                session('tracking_code')
            )
                ->where('user_id', auth()->id())
                ->first();
        }

        return view('mahasiswa.laporan.index', [
            'activeTab' => 'track',
            'laporanSaya' => $laporanSaya,
            'laporanDicari' => $laporanDicari,
        ]);
    }

    // ==========================================
    // HALAMAN STATUS LAMA
    // ==========================================

    public function statusForm()
    {
        $this->authorizeMahasiswa();

        return redirect()->route('emergency-reports.create');
    }

    // ==========================================
    // MENYIMPAN LAPORAN DARURAT
    // ==========================================

    public function store(Request $request)
    {
        $this->authorizeMahasiswa();

        $validated = $request->validate([

            'incident_type' => 'required|string|max:100',

            'location_category' => 'required|string|max:100',

            'location' => 'required|string|max:255',

            'detail_location' => 'required|string|max:255',

            'incident_time' => 'required|date',

            'reporter_name' => 'required|string|max:100',

            'reporter_phone' => [
                'required',
                'string',
                'max:20',
                'regex:/^[0-9+\s-]{9,20}$/',
            ],

            'description' => [
                'required',
                'string',
                'max:5000',

                function ($attribute, $value, $fail) {

                    $words = preg_split(
                        '/\s+/u',
                        trim($value),
                        -1,
                        PREG_SPLIT_NO_EMPTY
                    );

                    if (count($words) > 300) {
                        $fail(
                            'Ringkasan kejadian maksimal 300 kata.'
                        );
                    }
                },
            ],

            'confirmation' => 'accepted',

        ], [

            'incident_type.required' =>
                'Jenis kejadian wajib dipilih.',

            'location_category.required' =>
                'Kategori lokasi wajib dipilih.',

            'location.required' =>
                'Lokasi kejadian wajib diisi.',

            'detail_location.required' =>
                'Detail lokasi wajib diisi.',

            'incident_time.required' =>
                'Waktu kejadian wajib diisi.',

            'reporter_name.required' =>
                'Nama pelapor wajib diisi.',

            'reporter_phone.required' =>
                'Nomor WhatsApp wajib diisi.',

            'reporter_phone.regex' =>
                'Format nomor WhatsApp tidak valid.',

            'description.required' =>
                'Ringkasan kejadian wajib diisi.',

            'confirmation.accepted' =>
                'Persetujuan laporan wajib dicentang.',

        ]);

        // TRANSAKSI DATABASE

        $laporan = DB::transaction(function () use ($validated) {

            $laporan = EmergencyReport::create([

                'user_id' => auth()->id(),

                'incident_type' => $validated['incident_type'],

                'location_category' => $validated['location_category'],

                'location' => $validated['location'],

                'detail_location' => $validated['detail_location'],

                'incident_time' => $validated['incident_time'],

                'reporter_name' => $validated['reporter_name'],

                'reporter_phone' => $validated['reporter_phone'],

                'description' => $validated['description'],

                'status' => 'Menunggu',

            ]);

            // MEMBUAT KODE PELACAKAN UNIK

            $trackingCode = 'SRK-' .
                now()->format('Y') . '-' .
                str_pad(
                    (string) $laporan->id,
                    4,
                    '0',
                    STR_PAD_LEFT
                );

            $laporan->update([
                'tracking_code' => $trackingCode,
            ]);

            return $laporan;
        });

        // KEMBALI KE HALAMAN LAPOR
        // MENAMPILKAN KODE PELACAKAN

        return redirect()
            ->route('emergency-reports.create')
            ->with('success', 'Laporan darurat berhasil dikirim!')
            ->with('tracking_code', $laporan->tracking_code)
            ->with('active_tab', 'track');
    }

    // ==========================================
    // PENCARIAN STATUS LAPORAN
    // ==========================================

    public function track(Request $request)
    {
        $this->authorizeMahasiswa();

        $validated = $request->validate([

            'tracking_code' => 'required|string|max:50',

        ], [

            'tracking_code.required' =>
                'Kode pelacakan wajib diisi.',

        ]);

        $kode = strtoupper(
            trim($validated['tracking_code'])
        );

        // AMBIL SELURUH RIWAYAT LAPORAN MAHASISWA

        $laporanSaya = EmergencyReport::where(
            'user_id',
            auth()->id()
        )
            ->latest()
            ->get();

        // CARI LAPORAN BERDASARKAN KODE

        $laporanDicari = EmergencyReport::where(
            'tracking_code',
            $kode
        )
            ->where('user_id', auth()->id())
            ->first();

        // JIKA KODE TIDAK DITEMUKAN

        if (!$laporanDicari) {

            return redirect()
                ->route('emergency-reports.create')
                ->withErrors([
                    'tracking_code' =>
                        'Kode laporan tidak ditemukan. Periksa kembali kode Anda.',
                ])
                ->withInput([
                    'tracking_code' => $kode,
                ])
                ->with('active_tab', 'track');
        }

        // TAMPILKAN HASIL PENCARIAN

        return view('mahasiswa.laporan.index', [

            'activeTab' => 'track',

            'laporanSaya' => $laporanSaya,

            'laporanDicari' => $laporanDicari,

        ]);
    }

    // ==========================================
    // DAFTAR LAPORAN PETUGAS
    // ==========================================

    public function index()
    {
        $this->authorizePetugas();

        $laporan = EmergencyReport::with('user')
            ->latest()
            ->paginate(10);

        $totalLaporan = EmergencyReport::count();

        $laporanMenunggu = EmergencyReport::where(
            'status',
            'Menunggu'
        )->count();

        return view('petugas.laporan.index', compact(
            'laporan',
            'totalLaporan',
            'laporanMenunggu'
        ));
    }

    // ==========================================
    // DETAIL LAPORAN PETUGAS
    // ==========================================

    public function show($id)
    {
        $this->authorizePetugas();

        $laporan = EmergencyReport::with('user')
            ->findOrFail($id);

        return view(
            'petugas.laporan.show',
            compact('laporan')
        );
    }

    // ==========================================
    // UPDATE STATUS DAN TINDAK LANJUT
    // ==========================================

    public function update(Request $request, $id)
    {
        $this->authorizePetugas();

        $validated = $request->validate([

            'status' => 'required|in:Menunggu,Diproses,Selesai',

            'follow_up' => 'nullable|string|max:5000',

        ]);

        $laporan = EmergencyReport::findOrFail($id);

        $laporan->update([

            'status' => $validated['status'],

            'follow_up' => $validated['follow_up'] ?? null,

        ]);

        return redirect()
            ->route('petugas.laporan.show', $laporan->id)
            ->with(
                'success',
                'Tindak lanjut laporan berhasil diperbarui.'
            );
    }
}
