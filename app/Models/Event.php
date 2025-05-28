<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model

{
    use HasFactory; // Permet d'utiliser les factories pour les tests et le seed

    // Attributs pouvant être assignés en masse
    protected $fillable = ['title', 'description', 'start_time', 'location', 'category_id'];

    //Relation : une événement appartient à une catégorie
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    //Relation : un événement peut avoir plusieurs réservations
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
