<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->string('uid')->unique()->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('currency')->nullable();
            $table->string('currency_symbol')->nullable();
            $table->decimal('currency_rate', 10, 2)->default(0);
            $table->decimal('total', 10, 2)->default(0);
            $table->tinyInteger('status')->default(0)->comment('0-Waiting for approval, 1 - Action From Vendor, 2 - Accepted, 3 - Rejected, 4 - Requote, 5 - Proceeded to order');
            $table->tinyInteger('admin_status')->default(0)->comment('0-Waiting for approval, 2 - Accepted, 3 - Rejected, 4 - Requote, 5 - Proceeded to order');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('quotations');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
};
