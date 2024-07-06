<?php

namespace Database\Factories;

use App\Model\Client;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Crypt;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'document_type' => $this->faker->randomElement(['CC', 'TI', 'CE']),
            'document_number' => $this->faker->unique()->randomNumber(),
            'name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'phone' => $this->faker->phoneNumber,
            'neighborhood' => $this->faker->word,
            'address' => $this->faker->address,
            'city' => $this->faker->city,
            'profession' => $this->faker->jobTitle,
            'notes' => $this->faker->paragraph,
            'type' => $this->faker->randomElement(['bueno', 'calambre']),
            'created_by' => 1, // Puedes personalizar el valor del creador
            'modified_by' => 1, // Puedes personalizar el valor del modificador
        ];
    }
}
