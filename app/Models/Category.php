<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    //une catégorie peut avoir plusieurs événements
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
