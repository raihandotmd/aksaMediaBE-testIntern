<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EmployeeModel;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create 50 employees dummy data
        EmployeeModel::factory()->count(50)->create();
    }
}
