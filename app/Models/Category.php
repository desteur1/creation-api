<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory; // Permet d'utiliser les factories pour les tests et le seed

    // Attributs pouvant être assignés en masse
    protected $fillable = ['name', 'description'];

    //Relation : une catégorie peut avoir plusieurs événements
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
