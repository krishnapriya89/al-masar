<?php

namespace Database\Seeders;

use App\Models\Provider;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [

            [
                'name'             => 'Email',
                'created_at'       =>  Carbon::now(),
                'updated_at'       =>  Carbon::now()
            ],

        ];

        Provider::insert($data);
    }
}
