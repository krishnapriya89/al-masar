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
        Schema::create('currency_rates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('code_id');
            $table->foreign('code_id')->references('id')->on('currency_code_masters');
            $table->string('symbol')->nullable();
            $table->decimal('rate', 10, 3)->default(0);
            $table->integer('sort_order')->default(0);
            $table->tinyInteger('is_default')->default(0)->comment('1-is default, 0-not');
            $table->tinyInteger('status')->default(1)->comment('1:active','0:inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currency_rates');
    }
};
