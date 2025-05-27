<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['title', 'description', 'start_time', 'location', 'category_id'];

    // une événement appartient à une catégorie
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    // un événement peut avoir plusieurs réservations
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
