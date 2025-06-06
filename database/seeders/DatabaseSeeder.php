<?php

namespace Database\Seeders;

use App\Models\SignIn;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        \App\Models\SignIn::create([
            'name' => 'Super Admin',
            'email' => 'super@admin.com',
            'password' => Hash::make('1234567890'),
            'role' => 'super_admin',
            'region' => 'All',
            'status' => 'Active'
        ]);
    }
}
