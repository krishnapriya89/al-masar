<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\WhyChoose;

class WhyChooseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WhyChoose::insert([
            'title'=>'Why Choose Al Masar Al Saree',
            'sub_title' => 'lorem ipsum',
            'section_one_image'=>'frontend/images/w1.svg',
            'section_one_title'=>'Best Prices In The Market',
            'section_one_description'=>'lorem ipsum',
            'section_two_image'=>'frontend/images/w2.svg',
            'section_two_title'=>'Best Prices In The Market',
            'section_two_description'=>'lorem ipsum',
            'section_three_image'=>'frontend/images/w3.svg',
            'section_three_title'=>'Best Prices In The Market',
            'section_three_description'=>'lorem ipsum',
        ]);
    }
}
