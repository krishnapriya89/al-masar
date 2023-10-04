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
            'sub_title' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Qua ex cognitione facilior facta est',
            'section_one_image'=>'frontend/images/w1.svg',
            'section_one_title'=>'Best Prices In the Market',
            'section_one_description'=>'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore',
            'section_two_image'=>'frontend/images/w2.svg',
            'section_two_title'=>'Secured Transactions',
            'section_two_description'=>'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore',
            'section_three_image'=>'frontend/images/w3.svg',
            'section_three_title'=>'Fastest Delivery',
            'section_three_description'=>'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore',
        ]);
    }
}
