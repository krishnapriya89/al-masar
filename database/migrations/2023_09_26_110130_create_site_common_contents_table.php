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
        Schema::create('site_common_contents', function (Blueprint $table) {
            $table->id();
            $table->string('header_note')->nullable();
            $table->string('header_phone_number')->nullable();
            $table->longText('footer_description')->nullable();
            $table->text('address')->nullable();
            $table->string('enquiry_receive_email')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('payment_image')->nullable();
            $table->string('copy_right')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('twitter_link')->nullable();
            $table->string('linkedIn_link')->nullable();
            $table->string('menu_category')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_common_contents');
    }
};
