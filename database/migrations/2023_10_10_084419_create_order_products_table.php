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
        Schema::create('order_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_detail_id');
            $table->foreign('order_detail_id')->references('id')->on('order_details');
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->string('product_code')->nullable();
            $table->string('sku')->nullable();
            $table->string('specification')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->decimal('bid_price', 10, 2)->default(0);
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_products');
    }
};
