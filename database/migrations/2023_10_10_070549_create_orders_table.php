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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('uid')->unique()->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->decimal('sub_total', 10, 2)->default(0);
            $table->decimal('bid_sub_total', 10, 2)->default(0);
            $table->decimal('grand_total', 10, 2)->default(0);
            $table->string('currency_code')->nullable();
            $table->string('currency_symbol')->nullable();
            $table->decimal('currency_rate', 10, 2)->default(0);
            $table->unsignedBigInteger('payment_id')->default(0)->comment('1-Bank Transfer');
            $table->foreign('payment_id')->references('id')->on('payments');
            $table->string('tax_name')->nullable();
            $table->decimal('tax_percentage', 10, 3)->default(0);
            $table->decimal('tax_value', 10, 2)->default(0)->comment('Tax amount in the site settings');
            $table->decimal('tax_amount', 10, 2)->default(0)->comment('Tax of the sub total');
            $table->tinyInteger('payment_gateway_status')->default(0)->comment('0 - Pending, 1 - Success, 2 - Failed');
            $table->unsignedBigInteger('order_status_id')->nullable()->comment('1 - Pending, 2 - Shipped, 3 - Delivered');
            $table->foreign('order_status_id')->references('id')->on('order_statuses');
            $table->tinyInteger('status')->default(0)->comment('0 - Checkout Started, 2 - Order Confirmed, 3 - Order Cancelled');
            $table->tinyInteger('order_status')->default(0)->comment('0 - Ordered, 2 - Order Confirmed By Admin, 3 - Order Cancelled By Admin');
            $table->tinyInteger('payment_received_status')->default(0)->comment('0 - Checkout Started, 2 - Order Confirmed, 3 - Order Cancelled');
            $table->decimal('payment_received_amount', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
