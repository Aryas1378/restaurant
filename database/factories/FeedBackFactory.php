<?php

namespace Database\Factories;

use App\Models\FeedBack;
use Illuminate\Database\Eloquent\Factories\Factory;

class FeedBackFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FeedBack::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'description' => $this->faker->sentence
        ];
    }
}
