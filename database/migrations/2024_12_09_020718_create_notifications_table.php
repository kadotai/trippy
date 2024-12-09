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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // 通知を受け取るユーザーID
            $table->unsignedBigInteger('sender_id'); // 送った人のID
            $table->enum('notification_type', ['like', 'comment', 'other']); // 通知の種類
            $table->unsignedBigInteger('related_id'); //関連するリソースのID（例: 投稿ID、コメントIDなど）
            $table->text('message'); //通知内容
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');

            $table->index(['user_id', 'sender_id', 'related_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
