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
        Schema::create('how_to_buys', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('sub_title')->nullable();
            $table->string('image')->nullable();
            $table->string('section_one_title')->nullable();
            $table->longText('section_one_description')->nullable();
            $table->string('section_one_image')->nullable();
            $table->string('section_two_title')->nullable();
            $table->longText('section_two_description')->nullable();
            $table->string('section_two_image')->nullable();
            $table->string('section_three_title')->nullable();
            $table->longText('section_three_description')->nullable();
            $table->string('section_three_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('how_to_buys');
    }
};
