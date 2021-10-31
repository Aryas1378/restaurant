<?php

namespace Database\Factories;

use App\Models\Food;
use App\Models\FoodCategory;
use App\Models\MenuItem;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

class MenuItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MenuItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'restaurant_id' => Restaurant::factory()->create(),
            'food_id' => Food::factory()->create(),

        ];
    }
}
