<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClinicAppointment extends Model
{
    use HasFactory;

    /**
     * Jam buka klinik dan durasi tiap slot (menit).
     * Sesuaikan jika jam layanan atau durasi pemeriksaan berubah.
     */
    public const CLINIC_OPEN_HOUR = 8;
    public const SLOT_MINUTES = 10;

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

    /**
     * Nomor antrean berdasarkan slot jam kunjungan, bukan urutan booking.
     * 08:00 = A-01, 08:10 = A-02, ... 09:00 = A-07.
     * Pemakaian di view: {{ $kunjungan->queue_label }}
     */
    public function getQueueLabelAttribute(): string
    {
        $jam = \Carbon\Carbon::parse($this->jam);

        $menitSejakBuka = ($jam->hour * 60 + $jam->minute) - (self::CLINIC_OPEN_HOUR * 60);
        $nomor = max(0, intdiv($menitSejakBuka, self::SLOT_MINUTES)) + 1;

        return 'A-' . str_pad((string) $nomor, 2, '0', STR_PAD_LEFT);
    }
}