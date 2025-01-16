<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // seed db with admin account
        DB::table('users')->insert([
            'name' => 'Budi Setiawan',
            'username' => 'admin',
            'phone' => '08123456789',
            'email' => 'admin@pastibisa.com',
            'password' => Hash::make('pastibisa'),
        ]);

    }
}
