<?php

namespace Database\Factories;

use App\Models\Restaurant;
use App\Models\RestaurantType;
use Illuminate\Database\Eloquent\Factories\Factory;

class RestaurantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Restaurant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $restaurant_type = RestaurantType::factory()->create();
        return [
            'name' => $this->faker->name,
            'type_id' => $restaurant_type->id,
            'address' => $this->faker->address,
            'phone_number' => $this->faker->phoneNumber,
        ];
    }
}
