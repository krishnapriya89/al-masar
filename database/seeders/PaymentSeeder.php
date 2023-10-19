<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('payments')->truncate();
        $data = [
            [
                'image'         => 'frontend/images/pay4.png',
                'title'         => 'Bank Transfer',
                'description'   => 'Bank: Bank of America, NA, 555 California St, San Francisco, CA 94104 Business Name: Lizheng Stainless Steel Tube and Coil Corp Business Address: 3902 Henderson Blvd, Suite 208-207, Tampa, Florida, 33629 Swift #: BOFAUS3N Account #: 898037918555',
                'type'          =>  2,
                'sort_order'    =>  1,
                'status'        =>  1,
                'created_at'    =>  Carbon::now(),
                'updated_at'    =>  Carbon::now()
            ],
            [
                'image'         => 'frontend/images/bitcoin-usdt.svg',
                'title'         => 'Bitcoin / Tether (^BTCUSDT)',
                'description'   => 'Bank: Bank of America, NA, 555 California St, San Francisco, CA 94104 Business Name: Lizheng Stainless Steel Tube and Coil Corp Business Address: 3902 Henderson Blvd, Suite 208-207, Tampa, Florida, 33629 Swift #: BOFAUS3N Account #: 898037918555',
                'type'          =>  1,
                'sort_order'    =>  1,
                'status'        =>  1,
                'created_at'    =>  Carbon::now(),
                'updated_at'    =>  Carbon::now()
            ],
        ];

        Payment::insert($data);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
