<?php

namespace Tests\Feature;

use App\Models\Location;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LocationApiTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function it_lists_all_locations()
    {
        Location::factory()->count(10)->create();

        $response = $this->get('/api/locations');

        $response->assertStatus(200);
        $response->assertJsonCount(10);
    }

    public function it_can_create_a_location()
    {
        $data = [
            'name' => 'New Location',
            'latitude' => '40.7128',
            'longitude' => '-74.0060',
            'color' => '#FFFFFF'
        ];

        $response = $this->post('/api/locations', $data);

        $response->assertStatus(201);
        $this->assertDatabaseHas('locations', $data);
    }

    public function it_can_show_a_location()
    {
        $location = Location::factory()->create();

        $response = $this->get("/api/locations/{$location->id}");

        $response->assertStatus(200);
        $response->assertJson($location->toArray());
    }

    public function it_can_update_a_location()
    {
        $location = Location::factory()->create();

        $data = [
            'name' => 'Updated Location',
            'latitude' => '40.7128', 
            'longitude' => '-74.0060',
            'color' => '#000000'
        ];

        $response = $this->put("/api/locations/{$location->id}", $data);

        $response->assertStatus(200);
        $this->assertDatabaseHas('locations', array_merge(['id' => $location->id], $data));
    }

    public function it_can_delete_a_location()
    {
        $location = Location::factory()->create();

        $response = $this->delete("/api/locations/{$location->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('locations', ['id' => $location->id]);
    }
}
