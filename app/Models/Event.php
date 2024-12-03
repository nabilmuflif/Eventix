<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
// app/Models/Event.php
class Event extends Model
{

        // Tambahkan kolom yang ingin di-cast ke Carbon
        protected $dates = ['date'];

        // Mutator untuk memastikan date selalu dalam format Carbon
        public function getDateAttribute($value)
        {
            return $value ? Carbon::parse($value) : null;
        }
    
        // Setter untuk memastikan format yang konsisten
        public function setDateAttribute($value)
        {
            $this->attributes['date'] = $value 
                ? Carbon::parse($value)->format('Y-m-d') 
                : null;
        }
    public function usersFavorited()
    {
        return $this->belongsToMany(User::class, 'favorites', 'event_id', 'user_id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function getEventDateAttribute($value)
{
    return Carbon::parse($value);
}


    protected $fillable = [
        'name', 'description', 'event_date', 'location', 'ticket_price', 'ticket_quota', 'image', 'created_by'
    ];
    // Relasi dengan organizer (User)
    public function organizer() {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    // Relasi dengan pemesanan
    public function bookings() {
        return $this->hasMany(Booking::class);
    }
}
