<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class Like extends Model
{
    use HasFactory;

    // 一括代入可能な属性
    protected $fillable = ['user_id', 'post_id'];

    // リレーション: いいねの対象（投稿）
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // リレーション: いいねをしたユーザー
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
