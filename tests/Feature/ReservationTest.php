<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReservationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function cannot_create_reservation_with_missing_fields()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'sanctum')->postJson('/api/reservations', []);

        $response->assertStatus(422); // Unprocessable Entity
        $response->assertJsonValidationErrors(['event_id']);
    }

    /** @test */
    public function cannot_create_reservation_without_token()
    {
        $event = Event::factory()->create();

        $response = $this->postJson('/api/reservations', [
            'event_id' => $event->id,
            'places_reserved' => 1
        ]);

        $response->assertStatus(401); // Unauthorized
    }
}
