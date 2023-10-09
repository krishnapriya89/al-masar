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
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->tinyInteger('type')->default(1)->comment('1:Billing Address','2:Shipping Address');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->text('address_one')->nullable();
            $table->text('address_two')->nullable();
            $table->text('email')->nullable();
            $table->text('phone_number')->nullable();
            $table->string('city')->nullable();
            $table->unsignedBigInteger('country_id');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->unsignedBigInteger('state_id');
            $table->foreign('state_id')->references('id')->on('states');
            $table->string('zip_code')->nullable();
            $table->tinyInteger('is_default')->default(0)->comment('1:default,0:no');
            $table->tinyInteger('status')->default(1)->comment('1:active,0:Inactive');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_addresses');
    }
};
