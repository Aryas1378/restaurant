<?php

namespace Tests\Feature;

use App\Models\RestaurantType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RestaurantTypeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function testViewAllRestaurantTypesByAdmin()
    {
        $restaurant_types = RestaurantType::factory()->count(3)->create();

        $admin = $this->registerUser('admin');
        $this->actingAs($admin, 'sanctum');

        $response = $this->getJson(route('admin.restaurant-types.index'));
        $response->assertStatus(200);
        $response->assertSee($restaurant_types[0]->name);
    }

    public function testAdminCanCreateNewRestaurantType()
    {
        $admin = $this->registerUser('admin');
        $this->actingAs($admin, 'sanctum');

        $this->postJson(route('admin.restaurant-types.store'), [
                'name' => "sandwich",
        ])
            ->assertStatus(200)
            ->assertSee("operation successful");
    }

    public function testAdminCanViewOneSpecificRestaurantType()
    {
        $restaurant_types = RestaurantType::factory()->count(3)->create();

        $admin = $this->registerUser('admin');
        $this->actingAs($admin, 'sanctum');

        $this->assertDatabaseHas('restaurant_types', [
            'name' => $restaurant_types[0]->name,
        ]);

        $response = $this->getJson(route('admin.restaurant-types.show', 1));
        $response->assertStatus(200);
        $response->assertSee("operation successful");
    }
}
