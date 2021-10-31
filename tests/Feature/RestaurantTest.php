<?php

namespace Tests\Feature;

use App\Models\Restaurant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RestaurantTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function testAdminCanStoreRestaurant()
    {

        $restaurant = Restaurant::factory()->create();

        $admin = $this->registerUser('admin');
        $this->actingAs($admin, 'sanctum');

        $this->postJson(route('admin.restaurants.create'), $restaurant->toArray())
            ->assertStatus(200);
    }

    public function testAdminCanSeeAllRestaurants()
    {

        $restaurants = Restaurant::factory()->count(10)->create();

        $admin = $this->registerUser('admin');
        $this->actingAs($admin, 'sanctum');

        $this->getJson(route('admin.restaurants.index'))
            ->assertStatus(200)
            ->assertSee([
                'name' => $restaurants[0]->name
            ]);
    }

    public function testNameValidation()
    {

        Restaurant::factory()->count(10)->create();

        $admin = $this->registerUser('admin');
        $this->actingAs($admin, 'sanctum');

        $this->postJson(route('admin.restaurants.create'))
            ->assertStatus(401)
            ->assertSee('not valid request');
    }

    public function testAdminCanUpdateRestaurant()
    {

        Restaurant::factory()->count(10)->create();
        $updated_restaurant = Restaurant::factory()->create();

        $admin = $this->registerUser('admin');
        $this->actingAs($admin, 'sanctum');

        $this->patchJson(route('admin.restaurants.update', 1), $updated_restaurant->toArray())
            ->assertStatus(200);
    }

    public function testAdminCanDestroyOneSpecificRestaurant()
    {
        $restaurant = Restaurant::factory()->create();

        $admin = $this->registerUser('admin');
        $this->actingAs($admin, 'sanctum');

        $this->deleteJson(route('admin.restaurants.destroy', $restaurant))
            ->assertStatus(200)
            ->assertSee('Deletion was successfully');
    }

    public function testAdminCanCeeOneSpecificRestaurant()
    {
        $restaurant = Restaurant::factory()->create();

        $admin = $this->registerUser('admin');
        $this->actingAs($admin, 'sanctum');

        $this->getJson(route('admin.restaurants.show', $restaurant))
            ->assertStatus(200)
            ->assertSee([
                'id',
                'name',
            ]);
    }
}
