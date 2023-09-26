<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SiteCommonContent;

class SiteCommonContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SiteCommonContent::insert([
            'header_phone_number' => '+971 50475320',
            'footer_description' => 'Welcome to Al Masar Al Saree, your trusted partner in wholesale distribution of cutting-edge electronic gadgets in the United Arab Emirates.',
            'address'=>'P114 Sheikha Maryam Building - 9b - OFFICE 107 Al Maktoum Rd - Dubai - United Arab Emirates',
            'enquiry_receive_email'=>'almasar@admin.com',
            'phone' => '+971 50475320',
            'email'=>'sales@almasaralsaree.com',
            'payment_image'=>'frontend/images/pay.png',
            'copy_right' => '© 2023 All Rights Reserved Al Masar Al Saree 2023',
            'facebook_link'=>'https://www.facebook.com/',
            'instagram_link'=>'https://www.instagram.com/',
            'twitter_link'=> 'https://twitter.com/',
            'linkedIn_link'=>'https://www.linkedin.com/',
        ]);
    }
}
