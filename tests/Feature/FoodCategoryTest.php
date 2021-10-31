<?php

namespace Tests\Feature;

use App\Models\FoodCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FoodCategoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function testAdminCanCreateFoodCategory()
    {
        $food_category = FoodCategory::factory()->make();

        $admin = $this->registerUser('admin');
        $this->actingAs($admin, 'sanctum');

        $response = $this->postJson(route('admin.food-category.store'), $food_category->toArray())
            ->assertStatus(200);
    }

    public function testAdminCanSeeAllFoodsCategories()
    {
        $foods_categories = FoodCategory::factory()->count(5)->create();

        $admin = $this->registerUser('admin');
        $this->actingAs($admin, 'sanctum');

        $response = $this->getJson(route('admin.food-category.index'))
            ->assertStatus(200);

        $this->assertDatabaseHas('food_categories', [
            'name' => $foods_categories[0]->name,
        ]);
    }

    public function testAdminCanSeeOneSpecificFoodCategory()
    {
        $foods_categories = FoodCategory::factory()->count(5)->create();

        $admin = $this->registerUser('admin');
        $this->actingAs($admin, 'sanctum');

        $this->getJson(route('admin.food-category.show', 2))
            ->assertStatus(200)
            ->assertSee([
                'name' => $foods_categories[1]->name,
            ]);
    }

    public function testAdminCanUpdateFoodCategory()
    {
        FoodCategory::factory()->count(5)->create();

        $admin = $this->registerUser('admin');
        $this->actingAs($admin, 'sanctum');

        $this->patchJson(route('admin.food-category.update', 2), [
            'name' => 'something new ',
        ])
            ->assertStatus(200)
            ->assertSee([
                'data' => 'Updated successfully',
            ]);
    }

    public function testUpdateNameValidation()
    {
        $food_category = FoodCategory::factory()->create();

        $admin = $this->registerUser('admin');
        $this->actingAs($admin, 'sanctum');

        $this->patchJson(route('admin.food-category.update', $food_category))
            ->assertStatus(401)
            ->assertSee('not valid request');
    }

    public function testAdminCanDeleteFoodCategory()
    {
        FoodCategory::factory()->count(5)->create();

        $admin = $this->registerUser('admin');
        $this->actingAs($admin, 'sanctum');

        $this->deleteJson(route('admin.food-category.destroy', 2))
            ->assertStatus(200)
            ->assertSee([
                'data' => 'Deletion was successfully'
            ]);
    }

    public function testGuestCanNotSeeAllFoodsCategories()
    {
        $foods_categories = FoodCategory::factory()->count(5)->create();

        $admin = $this->registerUser('guest');
        $this->actingAs($admin, 'sanctum');

        $response = $this->getJson(route('admin.food-category.index'))
            ->assertStatus(403)
            ->assertSee('unauthorized');
    }

    public function testGuestCanNotSeeOneSpecificFoodCategory()
    {
        FoodCategory::factory()->count(5)->create();

        $admin = $this->registerUser('guest');
        $this->actingAs($admin, 'sanctum');

        $response = $this->getJson(route('admin.food-category.show', 2))
            ->assertStatus(403)
            ->assertSee('unauthorized');
    }
}
