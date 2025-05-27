<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'event_id', 'places_reserved'];
    // une réservation appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // une réservation appartient à un événement
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
