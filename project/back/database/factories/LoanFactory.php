<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Loans>
 */
class LoanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
<<<<<<< HEAD
            'route_id' => $this->faker->numberBetween(1, 15),
=======
            'route_id' => $this->faker->unique()->numberBetween(1, 15),
>>>>>>> b9da2c2 (ajustes para front y back)
            'client_id' => $this->faker->numberBetween(1,300),
            'amount' => $this->faker->randomElement(['120000', '180000', '220000', '250000']),
            'paymentDays' => $this->faker->randomElement(['L-S', 'V', 'L-V']),
            'paymentType' => $this->faker->randomElement(['9x7', '5x24', '9x25','12x15']),
            'deposit' => $this->faker->randomElement(['7', '5', '9', '12','0']),
            'lastInstallment' => $this->faker->randomElement(['3', '1', '5']),
            'remainingBalance' => $this->faker->randomElement(['120000', '100000', '50000']),
            'remainingAmount' => $this->faker->randomElement(['120000', '100000', '50000']),
            'daysPastDue' => $this->faker->randomElement(['0', '3', '7']),
            'lastPayment' => '2024-05-06',
            'startDate' => '2024-05-06',
            'finalDate' => '2024-05-30',
<<<<<<< HEAD
            'status'=> $this->faker->randomElement(['true', 'false']),
=======
>>>>>>> b9da2c2 (ajustes para front y back)
            'created_by' => 1,
            'modified_by' => 1,
        ];
    }
}
