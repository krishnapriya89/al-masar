<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'title'         => 'Pending',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'In Progress',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Shipped',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Delivered',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Rejected',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
        ];

        OrderStatus::insert($data);
    }
}
