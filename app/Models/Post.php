<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    protected $table = 'posts';

    // リレーション: 多対多 (Post と Tag)
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags', 'post_id', 'tag_id');
    }

    // リレーション: 1対多 (Post と Photo)
    public function photos()
    {
        return $this->hasMany(Post_image::class);
    }

    // フィルアブル属性 (一括代入可能な属性)
    protected $fillable = [
        'user_id', 'title', 'country', 'city', 'start_date',
        'end_date', 'content', 'route_data', 'distance',
        'duration', 'post_type'
    ];
}
