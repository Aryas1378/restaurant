<?php

namespace Tests\Feature;

use App\Models\Food;
use App\Models\FoodCategory;
use App\Models\MenuItem;
use App\Models\Restaurant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MenuItemTest extends TestCase
{
    use RefreshDatabase;

    public function testAdminCanCreateMenuItem()
    {
        $restaurant = Restaurant::factory()->create();
        $admin = $this->registerUser('admin');
        $this->actingAs($admin, 'sanctum');
        $this->withoutExceptionHandling();
        $food = Food::factory()->create();
        $categories = FoodCategory::factory()->count(3)->create();
        $this->postJson(route('admin.menu-items.store', $restaurant), [
            'food_id' => $food->id,
            'categories' => $categories->pluck('id'),

        ])
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'food',
                    'restaurant_id',
                ]
            ]);
    }

    public function testCreateMenuItemCategoryValidation()
    {
        $restaurant = Restaurant::factory()->create();

        $admin = $this->registerUser('admin');
        $this->actingAs($admin, 'sanctum');

        $food = Food::factory()->create();

        $categories = FoodCategory::factory()->count(3)->create();
        $this->postJson(route('admin.menu-items.store', $restaurant))->assertStatus(401);
    }

    public function testFoodIdValidation()
    {
        $restaurant = Restaurant::factory()->create();

        $admin = $this->registerUser('admin');
        $this->actingAs($admin, 'sanctum');

        $food = Food::factory()->create();

        $categories = FoodCategory::factory()->count(3)->create();
        $this->postJson(route('admin.menu-items.store', $restaurant), [
            'categories' => $categories->pluck('id'),
        ])
            ->assertStatus(401)
            ->assertSee('not valid request');
    }

    public function testNumericCategoryValidation()
    {
        $restaurant = Restaurant::factory()->create();
        $admin = $this->registerUser('admin');
        $this->actingAs($admin, 'sanctum');
        $food = Food::factory()->create();
        $categories = FoodCategory::factory()->count(3)->create();
        $this->postJson(route('admin.menu-items.store', $restaurant), [
            'food_id' => $food->id,
            'categories' => "jbjb",
        ])
            ->assertStatus(401)
            ->assertSee('not valid request');
    }

    public function testNumericFoodIdValidation()
    {
        $restaurant = Restaurant::factory()->create();
        $admin = $this->registerUser('admin');
        $this->actingAs($admin, 'sanctum');
        $food = Food::factory()->create();
        $categories = FoodCategory::factory()->count(3)->create();
        $this->postJson(route('admin.menu-items.store', $restaurant), [
            'food_id' => "something",
            'categories' => $categories->pluck('id'),
        ])
            ->assertStatus(401)
            ->assertSee('not valid request');
    }

    public function testAdminSeeAllMenuItem()
    {
        /** @var MenuItem $menuItem */
        $menuItem = MenuItem::factory()->create();

        $categories = FoodCategory::factory()->count(3)->create();

        $menuItem->categories()->attach($categories);

        $admin = $this->registerUser('admin');
        $this->actingAs($admin, 'sanctum');

        $this->getJson(route('admin.menu-items.index', $menuItem->restaurant))
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    [
                        'categories'
                    ]
                ]
            ]);
    }

    public function testAdminCanSeeOneSpecificMenuItem()
    {
        $menuItem = MenuItem::factory()->create();
        $categories = FoodCategory::factory()->count(3)->create();
        $menuItem->categories()->attach($categories);

        $admin = $this->registerUser('admin');
        $this->actingAs($admin, 'sanctum');

        $this->getJson(route('admin.menu-items.show', [$menuItem->restaurant, $menuItem]))
            ->assertJsonStructure([
                'data' => [
                    'food' => [
                        'id'
                    ],
                    'restaurant_id',
                ]
            ]);
    }

    public function testAdminCanDeleteOneMenuItem()
    {
        $menuItem = MenuItem::factory()->create();
        $categories = FoodCategory::factory()->create();
        $menuItem->categories()->attach($categories);

        $admin = $this->registerUser('admin');
        $this->actingAs($admin, 'sanctum');

        $this->deleteJson(route('admin.menu-items.destroy', [$menuItem->restaurant, $menuItem]))
            ->assertStatus(200)
            ->assertSee('menu item is deleted successfully');
    }

    public function testAdminUpdateOneSpecificMenuItem()
    {
        $menuItem = MenuItem::factory()->create();
        $categories = FoodCategory::factory()->count(3)->create();
        $menuItem->categories()->attach($categories);

        $admin = $this->registerUser('admin');
        $this->actingAs($admin, 'sanctum');

        $this->patchJson(route('admin.menu-items.update', [$menuItem->restaurant, $menuItem]), [
            'food_id' => Food::factory()->create()->id,
            'categories' => $categories->pluck('id'),
        ])
            ->assertStatus(200)
            ->assertSee([
                'data' => 'menu item is updated successfully',
            ]);
    }
}
