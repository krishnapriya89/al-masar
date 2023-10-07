<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Payment;

class BankTransferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Payment::insert([
            'image'=> 'frontend/images/pay4.png',
            'title'=>'Bank Transfer',
            'description'=>'Bank: Bank of America, NA, 555 California St, San Francisco, CA 94104 Business Name: Lizheng Stainless Steel Tube and Coil Corp Business Address: 3902 Henderson Blvd, Suite 208-207, Tampa, Florida, 33629 Swift #: BOFAUS3N Account #: 898037918555',
            'type' =>'2',
            'sort_order'=>'1',
            'status'=>'1'
        ]);
    }
}
