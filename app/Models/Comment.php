<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['post_id','user_id','content'];

    // コメントが属する投稿
    public function post()
    {
        return $this->belongsTo(Post::class,'post_id','id');
    }
}
