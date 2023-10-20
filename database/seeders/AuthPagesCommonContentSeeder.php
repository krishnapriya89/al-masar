<?php

namespace Database\Seeders;

use App\Models\AuthPageCommonContent;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AuthPagesCommonContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("auth_page_common_contents")->truncate();
        $data = [
            [
                'page'           => 'login-page',
                'form_title'         => 'Login',
                'image'          => 'frontend/images/log.jpg',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'page'           => 'register-page',
                'form_title'         => 'Register',
                'image'          => 'frontend/images/reg.jpg',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'page'           => 'otp-page',
                'form_title'         => 'OTP Verification',
                'image'          => 'frontend/images/otp.jpg',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
        ];

        AuthPageCommonContent::insert($data);
    }
}
