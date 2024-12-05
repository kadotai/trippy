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
        Schema::create('trippies', function (Blueprint $table) {
            $table->id(); //自動採番
            $table->varchar('name'); //名前（本名、あだ名ok）
            $table->varchar('icon')->nullable(); //ユーザーアイコン
            $table->enum('gender',['male', 'female', 'unspecified']); //性別
            $table->year('birth'); //誕生年
            $table->varchar('nationality'); //国籍（国コード）
            $table->varchar('email')->unique(); //メールアドレス
            $table->varchar('password'); //パスワード（ハッシュ化前提）
            $table->timestamps(); //登録、更新日時（自動）
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trippies');
    }
};
