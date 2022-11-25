<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Racket>
 */
class RacketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'brand' => fake()->randomElements(['yonex', 'adidas', 'lining'])[0],
            'color' => fake()->randomElements(['red', 'blue', 'yellow'])[0]
        ];
    }
}
