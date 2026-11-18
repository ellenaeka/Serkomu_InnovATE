<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Menampilkan halaman login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Memproses login pengguna
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Memeriksa email dan password ke database
        if (Auth::attempt($credentials)) {

            // Memperbarui session setelah login
            $request->session()->regenerate();

            $user = Auth::user();

            // Mengarahkan pengguna berdasarkan role
            if ($user->role === 'mahasiswa') {
                return redirect()->route('mahasiswa.dashboard');
            }

            if ($user->role === 'petugas') {
                return redirect()->route('petugas.dashboard');
            }

            // Jika role tidak dikenali
            Auth::logout();

            return redirect()->route('login')
                ->withErrors([
                    'email' => 'Role akun tidak dikenali.',
                ]);
        }

        // Jika email atau password salah
        return back()->withErrors([
            'email' => 'Email atau kata sandi yang dimasukkan salah.',
        ])->onlyInput('email');
    }

    // Memproses logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
