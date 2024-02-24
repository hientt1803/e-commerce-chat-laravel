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
        Schema::create('messages', function (Blueprint $table) {
            // Pk key
            $table->bigIncrements('msg_id');

            // Fk key
            $table->unsignedBigInteger('cvs_id');
            $table->foreign('cvs_id')->references('cvs_id')->on('conversions');

            // properties
            $table->integer('sender_id');
            $table->double('receiver_id')->default('1');
            $table->mediumText('content');
            $table->dateTime('send_time')->useCurrent();
            $table->string('status')->default('chưa đọc');

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
        Schema::dropIfExists('messages');
    }
};
