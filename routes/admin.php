<?php

use App\Http\Controllers\Admin\RestaurantTypeController;
use App\Http\Controllers\FoodCategoryController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\MenuItemsController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\RestaurantController;
use App\Models\Food;
use App\Models\FoodCategory;
use App\Models\MenuItem;
use App\Models\Photo;
use App\Models\Restaurant;
use App\Models\RestaurantType;
use Illuminate\Support\Facades\Route;

Route::prefix('/admin')->middleware('auth:sanctum')->group(function () {

    Route::post('restaurant-types', [RestaurantTypeController::class, 'store'])
        ->middleware("can:create," . RestaurantType::class)
        ->name('admin.restaurant-types.store');

    Route::get('restaurant-types', [RestaurantTypeController::class, 'index'])
        ->middleware("can:viewAny," . RestaurantType::class)
        ->name('admin.restaurant-types.index');

    Route::get('restaurant-types/{restaurantType}', [RestaurantTypeController::class, 'show'])
        ->middleware("can:view,restaurantType")
        ->name('admin.restaurant-types.show');

    Route::post('foods', [FoodController::class, 'store'])
        ->middleware('can:create,' . Food::class)
        ->name('admin.foods.store');

    Route::get('foods', [FoodController::class, 'index'])
        ->middleware('can:viewAny,' . Food::class)
        ->name('admin.foods.index');

    Route::get('foods/{food}', [FoodController::class, 'show'])
        ->middleware('can:view,food')
        ->name('admin.foods.show');

    Route::patch('foods/{food}', [FoodController::class, 'update'])
        ->middleware('can:update,food')
        ->name('admin.foods.update');

    Route::delete('foods/{food}', [FoodController::class, 'destroy'])
        ->middleware('can:delete,food')
        ->name('admin.foods.destroy');

    Route::post('food-category', [FoodCategoryController::class, 'store'])
        ->middleware('can:create,' . FoodCategory::class)
        ->name('admin.food-category.store');

    Route::get('food-category', [FoodCategoryController::class, 'index'])
        ->middleware('can:viewAny,' . FoodCategory::class)
        ->name('admin.food-category.index');

    Route::get('food-category/{foodCategory}', [FoodCategoryController::class, 'show'])
        ->middleware('can:view,foodCategory')
        ->name('admin.food-category.show');

    Route::patch('food-category/{foodCategory}', [FoodCategoryController::class, 'update'])
        ->middleware('can:update,foodCategory')
        ->name('admin.food-category.update');

    Route::delete('food-category/{foodCategory}', [FoodCategoryController::class, 'destroy'])
        ->middleware('can:delete,foodCategory')
        ->name('admin.food-category.destroy');

    Route::post('photos', [PhotoController::class, 'store'])
        ->middleware('can:create,' . Photo::class)
        ->name('admin.photos.store');

    Route::get('photos', [PhotoController::class, 'index'])
        ->middleware('can:viewAny,' . Photo::class)
        ->name('admin.photos.index');

    Route::get('photos/{photo}', [PhotoController::class, 'show'])
        ->middleware('can:view,photo')
        ->name('admin.photos.show');

    Route::patch('photos/{photo}', [PhotoController::class, 'update'])
        ->middleware('can:update,photo')
        ->name('admin.photos.update');

    Route::delete('photos/{photo}', [PhotoController::class, 'destroy'])
        ->middleware('can:delete,photo')
        ->name('admin.photos.delete');

    Route::post('restaurants', [RestaurantController::class, 'store'])
        ->middleware('can:create,' . Restaurant::class)
        ->name('admin.restaurants.create');

    Route::get('restaurants', [RestaurantController::class, 'index'])
        ->middleware('can:viewAny,' . Restaurant::class)
        ->name('admin.restaurants.index');

    Route::get('restaurants/{restaurant}', [RestaurantController::class, 'show'])
        ->middleware('can:view,restaurant')
        ->name('admin.restaurants.show');

    Route::delete('restaurants/{restaurant}', [RestaurantController::class, 'destroy'])
        ->middleware('can:delete,restaurant')
        ->name('admin.restaurants.destroy');


    Route::patch('restaurants/{restaurant}', [RestaurantController::class, 'update'])
        ->middleware('can:update,restaurant')
        ->name('admin.restaurants.update');

    Route::post('restaurants/{restaurant}/menu-items', [MenuItemsController::class, 'store'])
        ->middleware('can:create,' . MenuItem::class)
        ->name('admin.menu-items.store');

    Route::get('restaurants/{restaurant}/menu-items', [MenuItemsController::class, 'index'])
        ->middleware('can:viewAny,' . MenuItem::class)
        ->name('admin.menu-items.index');

    Route::get('restaurants/{restaurant}/menu-items/{menuItem}', [MenuItemsController::class, 'show'])
        ->middleware('can:view,menuItem')
        ->name('admin.menu-items.show');

    Route::delete('restaurants/{restaurant}/menu-items/{menuItem}', [MenuItemsController::class, 'destroy'])
        ->middleware('can:delete,menuItem')
        ->name('admin.menu-items.destroy');

    Route::patch('restaurants/{restaurant}/menu-items/{menuItem}', [MenuItemsController::class, 'update'])
        ->middleware('can:update,menuItem')
        ->name('admin.menu-items.update');


});
