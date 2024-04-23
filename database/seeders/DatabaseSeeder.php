<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();
        $user = \App\Models\User::factory()->create([
        'name' => 'Dinanr', // Change this to the desired name of the user
        'email' => 'dinanvanw@gmail.com', // Change this to the desired email of the user
        'password' => Hash::make('pass'),
        'remember_token' => Str::random(10),
        // Add any other attributes you want to set for the user
    ]);
        \App\Models\Car::factory(25)->create();
        \App\Models\Tag::factory(35)->create();
    }
}
