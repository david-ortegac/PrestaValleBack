<?php

namespace Database\Seeders;

use App\Models\Loan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LoansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
<<<<<<< HEAD
        $loan = Loan::factory()->count(1500)->create();
=======
        $loan = Loan::factory()->count(15)->create();
>>>>>>> d8914f2 (ajustes)
    }
}
