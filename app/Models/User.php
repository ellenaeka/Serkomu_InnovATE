<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'nim',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Memeriksa apakah pengguna adalah mahasiswa
    public function isMahasiswa(): bool
    {
        return $this->role === 'mahasiswa';
    }

    // Memeriksa apakah pengguna adalah petugas
    public function isPetugas(): bool
    {
        return $this->role === 'petugas';
    }
}
