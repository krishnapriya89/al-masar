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
        Schema::create('quotation_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quotation_id');
            $table->foreign('quotation_id')->references('id')->on('quotations');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products');
            $table->decimal('price', 10, 2)->default(0);
            $table->decimal('bid_price', 10, 2)->default(0);
            $table->decimal('admin_approved_price', 10, 2)->default(0);
            $table->integer('quantity')->default(0);
            $table->decimal('total_price', 10, 2)->default(0);
            $table->decimal('total_bid_price', 10, 2)->default(0);
            $table->text('remarks')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0-Waiting for approval, 1 - Action From Vendor, 2 - Accepted, 3 - Rejected, 4 - Rejected by Vendor, 5 - Proceeded to order');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotation_details');
    }
};
