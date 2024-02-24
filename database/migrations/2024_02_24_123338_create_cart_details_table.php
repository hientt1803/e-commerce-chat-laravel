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
        Schema::create('cart_details', function (Blueprint $table) {
            // Pk key
            $table->bigIncrements('cart_detail_id');

            // Fk key
            $table->unsignedBigInteger('cart_id');
            $table->unsignedBigInteger('product_id');
            $table->foreign('cart_id')->references('cart_id')->on('carts');
            $table->foreign('product_id')->references('product_id')->on('products');

            // properties
            $table->integer('quantity');

            // Log
            $table->timestamp('create_at')->comment('Thời điểm tạo')->useCurrent();
            $table->timestamp('update_at')->comment('Thời điểm cập nhật')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_details');
    }
};
