<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Post extends Model
{
    use HasFactory;
    
    protected $table = 'posts';

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags', 'post_id', 'tag_id');
    }

    public function images()
    {
        return $this->hasMany(Post_Image::class, 'post_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
