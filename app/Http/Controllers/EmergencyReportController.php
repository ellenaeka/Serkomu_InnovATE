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

        // Kembali ke dashboard setelah laporan berhasil dikirim
        return redirect()
            ->route('mahasiswa.dashboard')
            ->with('success', 'Laporan berhasil dikirim!');

    }
}
