<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // seed db with admin account
        User::create([
            'name' => 'Budi Setiawan',
            'username' => 'admin',
            'phone' => '08123456789',
            'email' => 'admin@pastibisa.com',
            'password' => Hash::make('pastibisa'),
        ]);

    }
}
