<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Date;

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
            'route_id' => $this->faker->numberBetween(1, 15),
            'client_id' => $this->faker->numberBetween(1,300),
            'order' => $this->faker->numberBetween(1, 30),
            'amount' => $this->faker->randomElement(['100000', '200000', '300000', '150000']),
            'dailyPayment' => $this->faker->randomElement(['6000','8000','10000','15000']),
            'daysToPay' => $this->faker->randomElement(['20','25','23','18']),
            'paymentDays' => $this->faker->randomElement(['*', 'Martes', 'Viernes','Lunes - Jueves', 'Sabado']),
            'deposit' => $this->faker->randomElement(['7', '5', '9', '12','0']),
            'pico' => $this->faker->randomElement(['7', '5','0']),
            'date'=> '2024-05-06',
            'daysPastDue' => $this->faker->randomElement(['0', '3', '7']),
            'balance'=>$this->faker->randomElement(['0', '1', '2', '3', '4', '5', '6', '7']),
            'dues'=>$this->faker->randomElement(['0', '1', '2', '3', '4', '5', '6', '7']),
            'lastPayment' => '2024-05-06',
            'startDate' => '2024-05-06',
            'finalDate' => '2024-05-30',
            'status'=> $this->faker->randomElement(['1', '0']),
            'created_by' => 1,
            'modified_by' => 1,
        ];
    }
}
