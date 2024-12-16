<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller
{
    public function create($post_id)
    {
        $post =Post::find($post_id);
        return view("posts.post",["post" =>$post]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'comment' => 'required|string|max:500', // コメントが必須で最大500文字
            'post_id' => 'required|exists:posts,id', // 有効な投稿ID
        ]);
    
        $post = Post::find($request->post_id);
        $comment = new Comment;
        $comment -> comment = $request -> comment;
        $comment -> user_id = Auth::id();
        $comment -> post_id = $request -> post_id;
        $comment -> save();
        
        //return view("posts.show",["post" =>$post]);
        return redirect()->route("posts.post",$post->id);
    }
}


