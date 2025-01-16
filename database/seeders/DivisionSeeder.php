<?php

namespace Database\Seeders;

use App\Models\DivisionModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $divisionData = [
            ['name' => 'Mobile Apps'],
            ['name' => 'QA'],
            ['name' => 'Full Stack'],
            ['name' => 'Backend'],
            ['name' => 'Frontend'],
            ['name' => 'UI/UX Designer']
        ];

        // seed db with division data, eloquent way
        collect($divisionData)->each(function ($division) {
            DivisionModel::create($division);
        });



    }
}
