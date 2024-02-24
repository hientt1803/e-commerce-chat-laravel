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
            // Pk key
            $table->bigIncrements('order_id');

            // Fk key
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('customer_id')->on('customers');

            // properties
            $table->string('name_receiver');
            $table->string('phone_receiver');
            $table->mediumText('address_receiver');
            $table->mediumText('notes');
            $table->double('total_price');
            $table->string('status')->default('đang chờ');

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
        Schema::dropIfExists('orders');
    }
};
