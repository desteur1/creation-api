<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Event;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EventTest extends TestCase
{
    use RefreshDatabase;

    public function test_event_creation_with_valid_data()
    {
        // Crée un user et une catégorie
        $user = User::factory()->create();
        $category = Category::factory()->create();

        // Fait la requête POST authentifiée pour créer un event
        $response = $this->actingAs($user)->postJson('/api/events', [
            'title' => 'Événement test',
            'description' => 'Description test',
            'start_time' => now()->addDay()->toDateTimeString(),
            'location' => 'Paris',
            'category_id' => $category->id,
        ]);

        $response->assertStatus(201); // Créé avec succès

        // Vérifie que l'event est bien en base
        $this->assertDatabaseHas('events', [
            'title' => 'Événement test',
            'location' => 'Paris',
            'category_id' => $category->id,
        ]);
    }
}
