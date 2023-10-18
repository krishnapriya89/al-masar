<?php

namespace Database\Seeders;

use App\Models\Provider;
use App\Models\ProviderDetail;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProviderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('provider_details')->truncate();
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
            [
                'provider_id'       => Provider::where('name', 'SMS API')->first()->id,
                'key'               => 'sms_send_api_url',
                'value'             => encrypt('https://customers.smartvision.ae/sms/smsapi?api_key={api_key}&type={type}&contacts={phone_number}&senderid={sender_id}&msg={message}'),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'provider_id'       => Provider::where('name', 'SMS API')->first()->id,
                'key'               => 'sms_check_balance_api_url',
                'value'             => encrypt('https://customers.smartvision.ae/sms/miscapi/{api_key}/getBalance'),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'provider_id'       => Provider::where('name', 'SMS API')->first()->id,
                'key'               => 'api_key',
                'value'             => encrypt('C2004445652e510aee24e6.09074721'),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'provider_id'       => Provider::where('name', 'SMS API')->first()->id,
                'key'               => 'main_sender_id',
                'value'             => encrypt('SmartVision'),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'provider_id'       => Provider::where('name', 'SMS API')->first()->id,
                'key'               => 'secondary_sender_id',
                'value'             => encrypt('SmartVision'),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
        ];

        ProviderDetail::insert($data);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
