<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClinicAppointment extends Model
{
    use HasFactory;

    /**
     * Nama tabel database.
     */
    protected $table = 'clinic_appointments';

    /**
     * Kolom yang dapat diisi melalui mass assignment.
     */
    protected $fillable = [
        'user_id',
        'booking_code',
        'queue_number',
        'estimated_call_time',
        'poli',
        'tanggal',
        'jam',
        'keluhan',
        'status',
        'cancellation_reason',
    ];

    /**
     * Konversi tipe data.
     */
    protected $casts = [
        'tanggal' => 'date',
    ];

    /**
     * Relasi dengan tabel users.
     * Satu pendaftaran dimiliki oleh satu mahasiswa.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
