<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmergencyReport extends Model
{
    protected $fillable = [
        'user_id',
        'incident_type',
        'location_category',
        'location',
        'detail_location',
        'incident_time',
        'reporter_name',
        'reporter_phone',
        'description',
        'status',
        'follow_up',
        'tracking_code',
    ];

    protected $casts = [
        'incident_time' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

