<?php

namespace Database\Seeders;

use App\Models\Provider;
use App\Models\ProviderDetail;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProviderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [


            [
                'provider_id'       => Provider::where('name', 'Email')->first()->id,
                'key'               => 'mailer',
                'value'             => encrypt('smtp'),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'provider_id'       => Provider::where('name', 'Email')->first()->id,
                'key'               => 'host',
                'value'             => encrypt('smtp-relay.sendinblue.com'),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'provider_id'       => Provider::where('name', 'Email')->first()->id,
                'key'               => 'port',
                'value'             => encrypt('587'),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'provider_id'       => Provider::where('name', 'Email')->first()->id,
                'key'               => 'username',
                'value'             => encrypt('suchith@intersmart.in'),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'provider_id'       => Provider::where('name', 'Email')->first()->id,
                'key'               => 'password',
                'value'             => encrypt('s0tEPf7m9H4Nqg2C'),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'provider_id'       => Provider::where('name', 'Email')->first()->id,
                'key'               => 'encryption',
                'value'             => encrypt('tls'),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'provider_id'       => Provider::where('name', 'Email')->first()->id,
                'key'               => 'from_address',
                'value'             => encrypt('suchith@intersmart.in'),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'provider_id'       => Provider::where('name', 'Email')->first()->id,
                'key'               => 'from_name',
                'value'             => encrypt('Vipera Tech'),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
        ];

        ProviderDetail::insert($data);
    }
}
