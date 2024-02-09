<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Alex',
            'email' => 'alex@example.ru',
            'password' => Hash::make('11111'),
        ]);

        User::create([
            'name' => 'Anna',
            'email' => 'anna@example.ru',
            'password' => Hash::make('22222'),
        ]);
    }
}
