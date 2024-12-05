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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); //自動採番
            $table->string('name'); //名前（本名、あだ名ok）
            $table->string('icon')->nullable(); //ユーザーアイコン
            $table->enum('gender',['male', 'female', 'unspecified']); //性別
            $table->year('birth'); //誕生年
            $table->string('nationality'); //国籍（国コード）
            $table->string('email')->unique(); //メールアドレス
            $table->string('password'); //パスワード（ハッシュ化前提）
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
