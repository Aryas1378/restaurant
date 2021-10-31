<?php

namespace Tests\Feature;

use App\Models\Food;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FoodTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function testAdminCanCreateFood()
    {
        $food = Food::factory()->create();
        $admin = $this->registerUser('admin');
        $this->actingAs($admin, 'sanctum');

        $response = $this->postJson(route('admin.foods.store'), [
            'name' => "sandwich",
        ]);
        $response->assertStatus(200);
    }

    public function testAdminCanSeeAllFoods()
    {
        $foods = Food::factory()->count(5)->create();

        $admin = $this->registerUser('admin');
        $this->actingAs($admin, 'sanctum');

        $response = $this->getJson(route('admin.foods.index'));
        $response->assertStatus(200);
        $response->assertSee($foods[0]->name);
        $this->assertDatabaseHas('foods', [
            'name' => $foods[0]->name,
        ]);
    }

    public function testAdminCanViewOneSpecificFood()
    {
        $foods = Food::factory()->count(5)->create();

        $admin = $this->registerUser('admin');
        $this->actingAs($admin, 'sanctum');

        $response = $this->getJson(route('admin.foods.show', 2));
        $response->assertStatus(200);
        $response->assertSee([
            'name' => $foods[1]->name,
        ]);
    }

    public function testAdminUpdateOneSpecificFood()
    {
        Food::factory()->count(5)->create();

        $admin = $this->registerUser('admin');
        $this->actingAs($admin, 'sanctum');

        $response = $this->patchJson(route('admin.foods.update', 2), [
            'name' => "something else",
        ])->assertStatus(200)->assertSee([
            'data' => "Update was successfully",
        ]);
    }

    public function testAdminDestroyOneSpecificFood()
    {
        $food = Food::factory()->create();

        $admin = $this->registerUser('admin');
        $this->actingAs($admin, 'sanctum');

        $this->deleteJson(route('admin.foods.destroy', $food))
            ->assertStatus(200)
            ->assertSee([
                'data' => 'Deletion was successful'
            ]);
    }

    public function testGuestDestroyOneSpecificFood()
    {
        $food = Food::factory()->create();

        $admin = $this->registerUser('guest');
        $this->actingAs($admin, 'sanctum');

        $this->deleteJson(route('admin.foods.destroy', $food))
            ->assertStatus(403)
            ->assertSee('unauthorized');
    }

    public function testGuestCanNotCreateFood()
    {
        $admin = $this->registerUser('guest');
        $this->actingAs($admin, 'sanctum');

        $response = $this->postJson(route('admin.foods.store'), [
            'name' => "sandwich",
        ])->assertStatus(403)->assertSee([
            'message' => 'unauthorized'
        ]);
    }

    public function testGuestCanNotUpdateFoods()
    {
        Food::factory()->count(5)->create();

        $admin = $this->registerUser('guest');
        $this->actingAs($admin, 'sanctum');

        $response = $this->patchJson(route('admin.foods.update', 2), [
            'name' => "something else",
        ])->assertStatus(403)->assertSee([
            'data' => "unauthorized",
        ]);
    }

    public function testGuestCanNotSeeOneSpecificFood()
    {
        $foods = Food::factory()->count(5)->create();

        $admin = $this->registerUser('guest');
        $this->actingAs($admin, 'sanctum');

        $response = $this->getJson(route('admin.foods.show', $foods[1]));
        $response->assertStatus(403);
        $response->assertSee([
            'data' => "unauthorized",
        ]);
    }
}
