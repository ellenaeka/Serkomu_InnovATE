<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmergencyReport;

class EmergencyReportController extends Controller
{
    // Memastikan hanya mahasiswa yang dapat membuat laporan
    private function authorizeMahasiswa()
    {
        abort_unless(
            auth()->check() && auth()->user()->role === 'mahasiswa',
            403,
            'Akses hanya untuk mahasiswa.'
        );
    }

    // Menampilkan halaman formulir laporan
    public function create()
    {
        $this->authorizeMahasiswa();

        return view('mahasiswa.laporan.create');
    }

    // Memproses dan menyimpan laporan
    public function store(Request $request)
    {
        $this->authorizeMahasiswa();

        // Validasi seluruh data laporan
        $validated = $request->validate([

            // LANGKAH 1: DATA KEJADIAN
            'incident_type' => 'required|string|max:100',

            'location_category' => 'required|string|max:100',

            'location' => 'required|string|max:255',

            'detail_location' => 'required|string|max:255',

            'incident_time' => 'required|date',

            // LANGKAH 2: DETAIL PELAPOR
            'reporter_name' => 'required|string|max:100',

            'reporter_phone' => [
                'required',
                'string',
                'max:20',
                'regex:/^[0-9+\-\s]{9,20}$/',
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
                        $fail('Ringkasan kejadian maksimal 300 kata.');
                    }
                },
            ],

            // LANGKAH 3: PERSETUJUAN
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

        // Simpan laporan ke database
        EmergencyReport::create([

            'user_id' => $request->user()->id,

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
        //membbuat kode pelacakan otomatis
        $trackingCode = 'SRK-' . now()->year . '-'.
        str_pad(EmergencyReport::latest()->first()->id + 1, 4, '0', STR_PAD_LEFT);

        $laporan->update([
            'tracking_code' => $trackingCode,
        ]);

        // Kembali ke dashboard setelah laporan berhasil dikirim
        return redirect()
            ->route('mahasiswa.dashboard')
            ->with('success', 'Laporan berhasil dikirim! Kode pelacakan: ' . $trackingCode);

    }
    // Memastikan hanya petugas yang dapat melihat daftar laporan
    private function authorizePetugas()
    {
        abort_unless(
            auth()->check() && auth()->user()->role === 'petugas',
            403,
            'Akses hanya untuk petugas.'
        );
    }

    // Menampilkan daftar laporan darurat untuk petugas
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
    // Menampilkan detail satu laporan
    public function show($id)
    {
        $this->authorizePetugas();

        $laporan = EmergencyReport::findOrFail($id);

        return view('petugas.laporan.show', compact('laporan'));
    }

    // Memproses tindak lanjut laporan oleh petugas
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
            'follow_up' => $validated['follow_up'],
        ]);

        return redirect()
            ->route('petugas.laporan.show', $laporan->id)
            ->with('success', 'Tindak lanjut laporan berhasil diperbarui.');
    }

    // Menampilkan halaman cek status laporan
    public function statusForm()
    {
        $this->authorizeMahasiswa();

        return view('mahasiswa.laporan.status');
    }


    // Mencari laporan berdasarkan kode pelacakan
    public function track(Request $request)
    {
        $this->authorizeMahasiswa();

        $request->validate([
            'tracking_code' => 'required|string|max:50',
        ]);

        $laporan = EmergencyReport::where(
            'tracking_code',
            $request->tracking_code
        )
        ->where('user_id', auth()->id())
        ->first();

        if (!$laporan) {
            return back()
                ->withErrors([
                    'tracking_code' => 'Kode pelacakan tidak ditemukan.'
                ])
                ->withInput();
        }

        return view('mahasiswa.laporan.status', compact('laporan'));
    }
    
}
