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
            $table->unsignedBigInteger('country_id');//国ID（外部キー）
            $table->string('title')->nullable(); //タイトル
            $table->date('start_date')->nullable(); //開始日
            $table->date('end_date')->nullable(); //最終日
            $table->string('city')->nullable(); //都市名
            $table->unsignedBigInteger('prefecture_id')->nullable();//都道府県ID（外部キー）
            $table->text('content')->nullable(); //コンテンツ
            $table->json('route_data')->nullable(); //ルートデータ
            $table->time('duration')->nullable(); //ルートトラッキングの時間
            $table->timestamps(); //created_at updated_at
            $table->boolean('post_type')->default(false); //公開/非公開


            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('prefecture_id')->references('id')->on('prefectures');
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
