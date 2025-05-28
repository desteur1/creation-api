<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

          // Ajoute une colonne 'status' (nullable) après 'places_reserved' dans la table 'reservations'
        Schema::table('reservations', function (Blueprint $table) {
            $table->string('status')->nullable()->after('places_reserved');
            
        });
    }

    /**
     * up() = appliquer la migration (ajouter la colonne)
     * down() = annuler la migration (supprimer la colonne)
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Supprime la colonne 'status' de la table 'reservations'
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
