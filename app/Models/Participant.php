<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Participant extends Model
{
    protected $fillable = [
        'booking_id',
        'name',
        'passport_no',
        'passport_expiry',
        'passport_file',
        'date_of_birth',
        'nationality',
    ];

    protected function casts(): array
    {
        return [
            'passport_expiry' => 'date',
            'date_of_birth' => 'date',
        ];
    }

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }
}