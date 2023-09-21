<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('about_us', function (Blueprint $table) {
            $table->id();
            $table->string('banner_title')->nullable();
            $table->longText('banner_description')->nullable();
            $table->string('banner_image')->nullable();
            $table->string('title')->nullable();
            $table->text('sub_title')->nullable();
            $table->string('image')->nullable();
            $table->longText('description')->nullable();
            $table->string('home_page_button_name')->nullable();
            $table->string('home_page_button_link')->nullable();
            $table->integer('section_one_value_one')->nullable();
            $table->string('section_one_title_one')->nullable();
            $table->integer('section_one_value_two')->nullable();
            $table->string('section_one_title_two')->nullable();
            $table->integer('section_one_value_three')->nullable();
            $table->string('section_one_title_three')->nullable();
            $table->integer('section_one_value_four')->nullable();
            $table->string('section_one_title_four')->nullable();
            $table->string('mission_title')->nullable();
            $table->string('mission_bg_image')->nullable();
            $table->longText('mission_description')->nullable();
            $table->string('vision_title')->nullable();
            $table->string('vision_bg_image')->nullable();
            $table->longText('vision_description')->nullable();
            $table->string('values_title')->nullable();
            $table->string('values_bg_image')->nullable();
            $table->longText('values_description')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->longText('meta_description')->nullable();
            $table->text('other_meta_tags')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_us');
    }
};
