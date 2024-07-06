<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'David Ortega',
            'email' => 'davidortegacadena@gmail.com',
            'password' => bcrypt('12345678'),
            'status' => true
        ]);

        $this->call(SedeSeeder::class);
        $this->call(RouteSeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(LoansSeeder::class);

    }
}
