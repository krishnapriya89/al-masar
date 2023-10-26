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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->decimal('price', 10, 2)->default(0);
            $table->decimal('bid_price', 10, 2)->default(0);
            $table->integer('quantity')->nullable();
            $table->decimal('total', 10, 2)->default(0);
            $table->decimal('total_bid_price', 10, 2)->default(0);
            $table->unsignedBigInteger('order_status_id')->nullable()->comment('1 - Pending, 2 - In Progress(Approved By Admin), 3 - Shipped, 4 - Delivered, 5 - Rejected');
            $table->foreign('order_status_id')->references('id')->on('order_statuses');
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
        Schema::dropIfExists('order_details');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
};
