<?php

namespace Database\Seeders;

use App\Models\Provider;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('providers')->truncate();
        $data = [

            [
                'name'             => 'Email',
                'created_at'       =>  Carbon::now(),
                'updated_at'       =>  Carbon::now()
            ],

            [
                'name'             => 'SMS API',
                'created_at'       =>  Carbon::now(),
                'updated_at'       =>  Carbon::now()
            ],
        ];

        Provider::insert($data);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
