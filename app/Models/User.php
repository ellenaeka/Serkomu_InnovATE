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
        'program_studi',
        'fakultas',
        'phone',
        'whatsapp',
        'auth_method',
        'profile_photo',
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

    public function isMahasiswa(): bool
    {
        return $this->role === 'mahasiswa';
    }

    public function isPetugas(): bool
    {
        return $this->role === 'petugas';
    }

    public function isSSO(): bool
    {
        return $this->auth_method === 'sso';
    }
}