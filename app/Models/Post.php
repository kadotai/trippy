<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Post_image;
use App\Models\Like;

class Post extends Model
{
    use HasFactory;
    
    protected $table = 'posts';

    // リレーション: 多対多 (Post と Tag)
    public function tags(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'post_tags', 'post_id', 'tag_id');
    }

    public function images()
    {
        return $this->hasMany(Post_Image::class, );
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // リレーション: 1対多 (Post と Photo)
    public function photos()
    {
        return $this->hasMany(Post_image::class);
    }

    // フィルアブル属性 (一括代入可能な属性)
    protected $fillable = [
        'user_id', 'title', 'country_id', 'city', 'start_date',
        'end_date', 'content', 'route_data', 'distance',
        'duration', 'post_type'
    ];
    //cana12/13

    public function country(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Country::class,'country_id','id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class,'post_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class,'post_id','id');
    }

    public function getLikesCountAttribute()
    {
    return $this->likes()->count();  // 関連するいいねの数をカウント
    }

    public function isLikedBy($user)
    {
        // ログイン中のユーザーがこの投稿をいいねしているかをチェック
        return $this->likes->contains('user_id', $user->id);
    }
}
