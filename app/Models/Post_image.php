<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post_image extends Model
{
    use HasFactory;
    protected $table = 'post_images'; // テーブル名を指定
    protected $fillable = ['post_id', 'img']; // カラムを指定

    // 外部キーリレーション
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
