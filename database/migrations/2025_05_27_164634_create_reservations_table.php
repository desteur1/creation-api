<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
      /**
     * Exécute la migration : crée la table 'reservations'
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
             $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('event_id')->constrained()->onDelete('cascade');
        $table->integer('places_reserved')->default(1); // optionnel : nombre de places
            $table->timestamps();
        });
    }

     /**
     * Annule la migration : supprime la table 'reservations'
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
