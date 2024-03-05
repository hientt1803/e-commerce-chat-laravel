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
        Schema::create('conversions', function (Blueprint $table) {
            // Pk key
            $table->bigIncrements('cvs_id');

            // Fk key
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('customer_id');
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('customer_id')->references('customer_id')->on('customers');

            // properties 
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
        Schema::dropIfExists('conversions');
    }
};
