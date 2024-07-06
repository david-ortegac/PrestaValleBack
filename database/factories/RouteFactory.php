<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Route;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Route>
 */
class RouteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sede_id'=>$this->faker->numberBetween(1,3),
            'name'=>$this->faker->streetName(),
            'created_by' => 1, // Puedes personalizar el valor del creador
            'modified_by' => 1, // Puedes personalizar el valor del modificador
        ];
    }
}
