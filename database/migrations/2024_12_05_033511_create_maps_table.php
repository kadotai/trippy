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
        Schema::create('maps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id'); //投稿ID（外部キー）
            $table->string('map_name'); //マップの名前
            $table->string('region'); //地域
            $table->decimal('latitude', 10, 8)->nullable(); // 緯度（最大10桁で小数点以下8桁）
            $table->decimal('longitude', 11, 8)->nullable(); // 経度（最大11桁で小数点以下8桁）
            $table->integer('zoom_level')->nullable(); // ズームレベル
            $table->timestamps(); //created_at updated_at

            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maps');
    }
};
