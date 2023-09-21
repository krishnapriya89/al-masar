<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Contact;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Contact::insert([
            'application_form_title'=>'Request More Info',
            'title'  => 'Get In Touch With Us',
            'description'=>'lorem ipsum',
            'background_image'=>'frontend/images/images.jpg',
            'phone'         => '97150475320',
            'email'         =>'sales@almasaralsaree.com'
        ]);
    }
}
