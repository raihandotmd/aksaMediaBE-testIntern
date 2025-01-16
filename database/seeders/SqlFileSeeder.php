<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SqlFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // seed db with sql file
        $sqlFile = base_path('database/sql/nilai.sql');
        $sql = file_get_contents($sqlFile);
        app('db')->unprepared($sql);
    }
}
