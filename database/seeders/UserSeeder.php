<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Akun mahasiswa
        User::updateOrCreate(
            ['nim' => '102022300199'],
            [
                'name' => 'Mahasiswa SerKoMu',
                'email' => 'mahasiswa@gmail.com',
                'role' => 'mahasiswa',
                'password' => 'password',
            ]
        );

        // Akun petugas
        $petugas = User::whereIn('email', [
            'petugas@serkomu.test',
            'petugas@gmail.com',
        ])->first();

        if (!$petugas) {
            $petugas = new User();
        }

        $petugas->name = 'Petugas SerKoMu';
        $petugas->email = 'petugas@gmail.com';
        $petugas->nim = null;
        $petugas->role = 'petugas';
        $petugas->password = 'password';
        $petugas->save();
    }
}
