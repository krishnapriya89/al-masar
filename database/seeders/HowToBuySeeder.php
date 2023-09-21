<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HowToBuy;

class HowToBuySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HowToBuy::insert([
            'title'         =>'How To Buy Form',
            'sub_title'     =>'It is easy to purchase product from us',
            'image'         =>'frontend/images/image.jpg',
            'section_one_title' =>'Get Registered',
            'section_one_description'   =>'lorem ipsum',
            'section_one_image' =>'frontend/images/image.jpg',
            'section_two_title' =>'Get Your Quote',
            'section_two_description'=>'lorem ipsum',
            'section_two_image' => 'frontend/images/image.jpg',
            'section_three_title' =>'Get Your Quote',
            'section_three_description'=>'lorem ipsum',
            'section_three_image' => 'frontend/images/image.jpg',
        ]);
    }
}
