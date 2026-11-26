<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\EmergencyReport;
use App\Models\ClinicAppointment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
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
        $user = $request->user();

        // Telepon & WhatsApp boleh diubah semua mahasiswa.
        $rules = [
            'phone' => ['nullable', 'string', 'max:20'],
            'whatsapp' => ['nullable', 'string', 'max:20'],
        ];

        // Program studi & fakultas hanya untuk akun non-SSO.
        // Untuk akun SSO, field ini tidak divalidasi dan tidak disimpan,
        // walaupun dikirim lewat request manual.
        if (! $user->isSSO()) {
            $rules['program_studi'] = ['required', 'string', 'max:100'];
            $rules['fakultas'] = ['required', 'string', Rule::in(config('serkomu.fakultas_list', []))];
        }

        // validate() hanya mengembalikan key yang ada di $rules,
        // sehingga role, nim, name, email, dll. otomatis diabaikan.
        $validated = $request->validate($rules, [
            'program_studi.required' => 'Program studi wajib diisi.',
            'program_studi.max' => 'Program studi maksimal 100 karakter.',
            'fakultas.required' => 'Fakultas wajib dipilih.',
            'fakultas.in' => 'Fakultas yang dipilih tidak valid.',
            'phone.max' => 'Nomor telepon maksimal 20 karakter.',
            'whatsapp.max' => 'Nomor WhatsApp maksimal 20 karakter.',
        ]);

        if (isset($validated['program_studi'])) {
            $validated['program_studi'] = trim($validated['program_studi']);
        }

        $user->update($validated);

        return redirect()
            ->route('mahasiswa.akun')
            ->with('success', 'Profil berhasil diperbarui.');
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

        public function passwordForm()
    {
        abort_unless(auth()->user()->role === 'mahasiswa', 403);

        return view('mahasiswa.ubah-kata-sandi');
    }
}