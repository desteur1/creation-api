<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory; // Permet d'utiliser les factories pour les tests et le seed

    // Attributs pouvant être assignés en masse
    protected $fillable = ['user_id', 'event_id', 'places_reserved','status'];
    //Relation : une réservation appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //Relation : une réservation appartient à un événement
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
