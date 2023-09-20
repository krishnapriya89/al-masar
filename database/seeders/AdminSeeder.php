<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::create([
            'first_name'      => 'Admin',
            'user_type' => 'Admin',
            'email'     => 'admin@almasar.com',
            'username'     => 'admin@almasar.com',
            'password'  => Hash::make('x7I9>5dOz7I£0'),
        ]);
    }
}
