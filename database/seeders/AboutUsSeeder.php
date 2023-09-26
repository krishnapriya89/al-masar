<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AboutUs;

class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AboutUs::insert([
            'banner_title' => 'Who We Are',
            'banner_description'=>'Lorem Ipsum',
            'banner_image'  => 'frontend/images/banner1.jpg',
            'title'=>'A Whole Sale Distributor of Electronic Gadgets in the UAE',
            'sub_title'=>'About Us',
            'image'=>'frontend/images/h1.jpg',
            'description'=>'lorem ipsum',
            'home_page_button_name'=>'Retailer',
            'home_page_button_link'=>'dfghj',
            'section_one_value_one'=>'13',
            'section_one_title_one'=>'years of experience',
            'section_one_value_two'=>'1000',
            'section_one_title_two'=>'clients',
            'section_one_value_three'=>'50',
            'section_one_title_three'=>'products',
            'section_one_value_four'=>'14',
            'section_one_title_four'=>'countries',
            'mission_title' => 'Mission',
            'mission_bg_image'=> 'frontend/images/m.jpg',
            'mission_description'=>'lorem ipsum',
            'vision_title'=>'Vision',
            'vision_bg_image'=>'frontend/images/v.jpg',
            'vision_description'=> 'lorem ipsum',
            'values_title'=>'Values',
            'values_bg_image'=>'frontend/images/val.jpg',
            'values_description'=>'lorem ipsum',
            'meta_title'=>'about',
            'meta_keywords'=>'about',
            'meta_description'=>'lorem ipsum',
            'other_meta_tags'=> '<meta>',
        ]);
    }
}
