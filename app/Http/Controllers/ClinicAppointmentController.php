<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClinicAppointment;
use Illuminate\Support\Str;

class ClinicAppointmentController extends Controller
{
    // Menampilkan form pendaftaran
    public function create()
    {
        return view('mahasiswa.klinik.create');
    }

    // Menyimpan pendaftaran
    public function store(Request $request)
    {
        $request->validate([
            'poli' => 'required|in:Poli Umum,Poli Gigi',
            'tanggal' => 'required|date|after_or_equal:today',
            'jam' => 'required',
            'keluhan' => 'nullable|string|max:1000',
        ]);

        ClinicAppointment::create([
            'user_id' => auth()->id(),
            'booking_code' => 'KLINIK-' . strtoupper(Str::random(8)),
            'poli' => $request->poli,
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
            'keluhan' => $request->keluhan,
            'status' => 'Menunggu',
        ]);

        return redirect()
            ->route('mahasiswa.klinik')
            ->with('success', 'Pendaftaran klinik berhasil!');
    }

    // MENAMPILKAN RIWAYAT KUNJUNGAN KLINIK
    public function history()
    {
        $riwayat = ClinicAppointment::where(
            'user_id',
            auth()->id()
        )
        ->latest()
        ->get();

        return view('mahasiswa.klinik-riwayat', compact('riwayat'));
    }
}
