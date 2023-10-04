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
            'title'         =>'How to Buy From Us',
            'sub_title'     =>'Its an easy process to purchase products from us.',
            'image'         =>'frontend/images/h1.jpg',
            'section_one_title' =>'Get Registered',
            'section_one_description'   =>'Quisque Lorem Tortor Fringilla Sed, Vestibulum Id, Eleifend Justo Bibendum Sapien Massaurpis Faucibus.',
            'section_one_image' =>'frontend/images/image.jpg',
            'section_two_title' =>'Get Your Quote',
            'section_two_description'=>'Quisque Lorem Tortor Fringilla Sed, Vestibulum Id, Eleifend Justo Bibendum Sapien Massaurpis Faucibus.',
            'section_two_image' => 'frontend/images/image.jpg',
            'section_three_title' =>'Get Your Products',
            'section_three_description'=>'Quisque Lorem Tortor Fringilla Sed, Vestibulum Id, Eleifend Justo Bibendum Sapien Massaurpis Faucibus.',
            'section_three_image' => 'frontend/images/image.jpg',
        ]);
    }
}
