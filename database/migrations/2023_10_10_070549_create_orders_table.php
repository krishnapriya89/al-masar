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
            $table->unsignedBigInteger('order_status_id')->nullable()->comment('1 - Pending, 2 - In Progress(Approved By Admin), 3 - Shipped, 4 - Delivered, 5 - Rejected');
            $table->foreign('order_status_id')->references('id')->on('order_statuses');
            $table->tinyInteger('status')->default(0)->comment('0 - Checkout Started, 1 - Order Detail, 2 - Order Address, 3 - Order Confirmed, 4 - Order Cancelled');
            $table->tinyInteger('payment_received_status')->default(0)->comment('0 - Not Received, 1 - Partial Amount Received, 2 - Full Received');
            $table->decimal('payment_received_amount', 10, 2)->default(0);
            $table->text('admin_remarks')->nullable();
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
        Schema::dropIfExists('orders');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
};
