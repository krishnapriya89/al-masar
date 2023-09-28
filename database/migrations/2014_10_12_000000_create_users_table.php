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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('user_type',['Admin','User'])->default('User');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('office_phone')->nullable();
            $table->string('company')->nullable();
            $table->text('address')->nullable();
            $table->string('attachment')->nullable();
            $table->tinyInteger('phone_verified')->default(0)->comment('0-Not Verified, 1-Verified');
            $table->tinyInteger('office_phone_verified')->default(0)->comment('0-Not Verified, 1-Verified');
            $table->tinyInteger('email_verified')->default(0)->comment('0-Not Verified, 1-Verified');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1:active,0:inactive');
            $table->tinyInteger('register_status')->default(0)->comment('0:not registered,1:register completed,2-phone verification,3-office phone verification');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
