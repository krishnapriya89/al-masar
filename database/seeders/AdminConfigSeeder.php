<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\AdminConfig;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admin_configs')->truncate();
        $data = [
            [
                'key'           => 'website_name',
                'value'         => 'Al Masar Al Saree',
                'type'          => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'key'           => 'website_logo',
                'value'         => 'frontend/images/Logo.svg',
                'type'          => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'key'           => 'website_primary_color',
                'value'         => '#1d1926',
                'type'          => 2,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'key'           => 'website_secondary_color',
                'value'         => '#c2c7d0',
                'type'          => 2,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'key'           => 'website_tertiary_color',
                'value'         => '#662c9c',
                'type'          => 2,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
        ];

        AdminConfig::insert($data);
    }
}
