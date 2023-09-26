<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PrivacyPolicy;

class PrivacyPolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PrivacyPolicy::insert([
            'title' => 'Privacy Policy',
            'description'=>'lorem ipsum',
            'meta_title'=>'privacy policy',
            'meta_keywords'=>'privacy',
            'meta_description'=>'lorem ipsum',
            'other_meta_tags'=>'<meta>'
        ]);
    }
}
