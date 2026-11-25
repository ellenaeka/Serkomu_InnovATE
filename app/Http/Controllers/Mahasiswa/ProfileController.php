<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\EmergencyReport;
use App\Models\ClinicAppointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        abort_unless($user->role === 'mahasiswa', 403);

        $totalLaporanSelesai = EmergencyReport::where(
            'user_id',
            $user->id
        )->where('status', 'Selesai')->count();

        $totalKunjungan = ClinicAppointment::where(
            'user_id',
            $user->id
        )->count();

        return view('mahasiswa.akun', compact(
            'user',
            'totalLaporanSelesai',
            'totalKunjungan'
        ));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        abort_unless($user->role === 'mahasiswa', 403);

        $validated = $request->validate([
            'phone' => 'nullable|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
        ]);

        $user->update($validated);

        return redirect()
            ->route('mahasiswa.akun')
            ->with('success', 'Informasi kontak berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $user = auth()->user();

        abort_unless($user->role === 'mahasiswa', 403);

        $validated = $request->validate([
            'current_password' => [
                'required',
                'current_password'
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed'
            ],
        ], [
            'current_password.current_password' =>
                'Kata sandi lama tidak sesuai.',
            'password.min' =>
                'Kata sandi baru minimal 8 karakter.',
            'password.confirmed' =>
                'Konfirmasi kata sandi tidak cocok.',
        ]);

        $user->update([
            'password' => $validated['password']
        ]);

        return redirect()
            ->route('mahasiswa.akun')
            ->with('success', 'Kata sandi berhasil diperbarui.');
    }
}