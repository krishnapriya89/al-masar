<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TaxManagement;

class TaxManagementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TaxManagement::insert([
            'tax_name' => 'VAT',
            'tax_percentage'=>.3,
            'tax_amount'=> 200
        ]);
    }
}
