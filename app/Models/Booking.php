<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/Booking.php
class Booking extends Model
{

    protected $fillable = [
        'user_id', 'event_id', 'status',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // Accessor untuk kelas status
    public function getStatusClassAttribute()
    {
        return match($this->status) {
            'approved' => 'approved',
            'pending' => 'pending',
            'cancelled' => 'cancelled',
            default => ''
        };
    }

    // Accessor untuk badge status
    public function getStatusBadgeClassAttribute()
    {
        return match($this->status) {
            'approved' => 'bg-success',
            'pending' => 'bg-warning text-dark',
            'cancelled' => 'bg-danger',
            default => 'bg-secondary'
        };
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}

