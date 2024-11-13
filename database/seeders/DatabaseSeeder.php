<?php

namespace Database\Seeders;

use App\Models\SignIn;
use App\Models\User;
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
        // User::factory(10)->create();

        \App\Models\SignIn::create([
            'email' => 'admin@retired.com',
            'password' => Hash::make('1234567890'),
        ]);
    }
}
