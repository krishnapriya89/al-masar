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
            'banner_description'=>'Lorem ipsum dolor sit amet, consectetur
            adipiscing elit. Illa videamus, quae a te de amicitia',
            'banner_image'  => 'frontend/images/banner1.jpg',
            'title'=>'A Wholesale Distributor of Electronic Gadgets in the UAE.',
            'sub_title'=>'About Us',
            'image'=>'frontend/images/a1.jpg',
            'description'=>'Welcome to Al Masar Al Saree, your trusted partner in wholesale distribution of cutting-edge electronic gadgets in the United Arab Emirates. With a relentless commitment to quality and innovation, we are dedicated to fueling the success of retailers by providing them with a diverse range of high-demand products.
            At Al Masar Al Saree, we understand the dynamic nature of the retail industry and the pivotal role technology plays in shaping its future. Our mission is to bridge the gap between manufacturers and retailers, offering a wide array of smartphones, laptops, smartwatches, and more, all available in substantial quantities to meet your business needs.',
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
            'mission_description'=>'At Al Masar Al Sarie, our mission is to empower retailers with the latest and most innovative electronic gadgets, providing them with a competitive edge in the market.',
            'vision_title'=>'Vision',
            'vision_bg_image'=>'frontend/images/v.jpg',
            'vision_description'=> 'Our vision is to be the premier wholesale distributor of electronic gadgets, recognized for our unwavering commitment to excellence, reliability, and innovatio',
            'values_title'=>'Values',
            'values_bg_image'=>'frontend/images/val.jpg',
            'values_description'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aut haec tibi, Torquate, sunt vituperanda aut patrocinium voluptatis repudiandum. Sint ista Graecorum; Erit enim mecum, si tecum erit. Ergo in utroque.',
            'meta_title'=>'about',
            'meta_keywords'=>'about',
            'meta_description'=>'lorem ipsum',
            'other_meta_tags'=> '<meta>',
        ]);
    }
}
