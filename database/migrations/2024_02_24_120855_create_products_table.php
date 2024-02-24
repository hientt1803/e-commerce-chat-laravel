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
        Schema::create('products', function (Blueprint $table) {
            // PK key
            $table->bigIncrements('product_id');

            // FK key
            $table->unsignedBigInteger('cat_id');
            $table->foreign('cat_id')->references('cat_id')->on('categories');

            // Properties
            $table->string('product_name');
            $table->double('price');
            $table->integer('quantity');
            $table->mediumText('description')->nullable();
            $table->string('image');
            $table->boolean('status')->default(true);

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
        Schema::dropIfExists('products');
    }
};
