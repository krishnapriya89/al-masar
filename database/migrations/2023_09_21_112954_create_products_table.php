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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_main_category_id')->nullable();
            $table->foreign('product_main_category_id')->references('id')->on('product_main_categories');
            $table->unsignedBigInteger('product_sub_category_id')->nullable();
            $table->foreign('product_sub_category_id')->references('id')->on('product_sub_categories');
            $table->unsignedBigInteger('product_sub_category_child_id')->nullable();
            $table->foreign('product_sub_category_child_id')->references('id')->on('product_sub_categories');
            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->foreign('vendor_id')->references('id')->on('vendors');
            $table->text('title')->nullable();
            $table->string('product_code')->nullable();//unique
            $table->string('model_number')->nullable();//not unique
            $table->string('sku')->nullable();//unique
            $table->string('slug');//unique
            $table->string('image')->nullable();
            $table->string('detail_page_image')->nullable();
            $table->string('thumbnail_image')->nullable();
            $table->longText('description')->nullable();
            $table->longText('specification')->nullable();
            $table->longText('search_keywords')->nullable();
            $table->integer('stock')->default(0);
            $table->integer('min_stock')->default(0);
            $table->tinyInteger('stock_status')->default(1)->comment('1:in stock,0:out of stock');
            $table->decimal('base_price', 10, 2)->default(0);
            $table->integer('discount_type')->default(0)->comment('1 - Flat, 2 - Percentage');
            $table->decimal('discount', 10, 2)->default(0);
            $table->integer('min_quantity_to_buy')->default(0);
            $table->integer('sort_order')->default(0);
            $table->tinyInteger('status')->default(1)->comment('1:active,0:inactive');
            $table->longText('meta_title')->nullable();
            $table->longText('meta_keyword')->nullable();
            $table->longText('meta_description')->nullable();
            $table->longText('other_meta_tags')->nullable();
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
        Schema::dropIfExists('products');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
};
