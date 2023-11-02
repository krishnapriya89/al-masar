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
            'name'      => 'Admin',
            'user_type' => 'Admin',
            'email'     => 'admin@almasar.com',
            'password'  => Hash::make('gQCT(gInr0kS'),
        ]);
    }
}
