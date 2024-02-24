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
        Schema::create('carts', function (Blueprint $table) {
            // PK key
            $table->bigIncrements('cart_id');

            // Fk key
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('customer_id')->on('customers');

            // Properties
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
        Schema::dropIfExists('carts');
    }
};
