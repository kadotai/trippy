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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); //ユーザーID（外部キー）
            $table->string('title')->nullable(); //タイトル
            $table->string('country')->nullable(); //国
            $table->date('start_date')->nullable(); //開始日
            $table->date('end_date')->nullable(); //最終日
            $table->string('city')->nullable(); //都市名
            $table->text('content')->nullable(); //コンテンツ
            $table->json('route_data')->nullable(); //ルートデータ
            $table->time('duration')->nullable(); //ルートトラッキングの時間
            $table->timestamps(); //created_at updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
