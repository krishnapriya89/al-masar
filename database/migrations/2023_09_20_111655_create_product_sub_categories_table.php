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
        Schema::create('product_sub_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_main_category_id');
            $table->foreign('product_main_category_id')->references('id')->on('product_main_categories');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('title');
            $table->string('slug');
            $table->integer('sort_order')->default(0);
            $table->tinyInteger('is_last_child')->default(1)->comment('1:yes,0:no');
            $table->tinyInteger('status')->default(1)->comment('1:active,0:inactive');
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
        Schema::dropIfExists('product_sub_categories');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
};
