<?php

namespace Database\Seeders;

use App\Models\CurrencyRate;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CurrencyRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CurrencyRate::create([
            'symbol' => '$',
            'code_id' => 1,
            'rate' => 1,
            'sort_order' => 1,
            'status' => 1,
            'is_default' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
