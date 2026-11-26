<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route(
                Auth::user()->role === 'petugas'
                    ? 'petugas.dashboard'
                    : 'mahasiswa.dashboard'
            );
        }

        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'nim' => ['required', 'digits_between:8,15', 'unique:users,nim'],
            'fakultas' => ['required', 'string', Rule::in(config('serkomu.fakultas_list', []))],
            'program_studi' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email:rfc', 'max:150', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'nim.required' => 'NIM wajib diisi.',
            'nim.digits_between' => 'NIM harus berupa angka (8–15 digit).',
            'nim.unique' => 'NIM ini sudah terdaftar.',
            'fakultas.required' => 'Fakultas wajib dipilih.',
            'fakultas.in' => 'Fakultas yang dipilih tidak valid.',
            'program_studi.required' => 'Program studi wajib diisi.',
            'program_studi.max' => 'Program studi maksimal 100 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah terdaftar.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.min' => 'Kata sandi minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        // Role dan metode autentikasi SELALU ditetapkan di server,
        // tidak pernah diambil dari input pengguna.
        $user = User::create([
            'name' => $validated['name'],
            'nim' => $validated['nim'],
            'fakultas' => $validated['fakultas'],
            'program_studi' => trim($validated['program_studi']),
            'email' => $validated['email'],
            'password' => $validated['password'], // di-hash otomatis oleh cast 'hashed'
            'role' => 'mahasiswa',
            'auth_method' => 'manual',
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()
            ->route('mahasiswa.dashboard')
            ->with('success', 'Akun berhasil dibuat. Selamat datang di SerKoMu!');
    }
}