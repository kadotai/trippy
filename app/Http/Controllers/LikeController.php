<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function like(Request $request,Post $post)
{
    //すでにいいねされていないか確認
    if (!$post->likes()->where('user_id', $request->user()->id)->exists()) {        $post->likes()->create([
            'user_id' =>$request->user()->id,
        ]);
    }
    return response()->json(['message' => 'いいねしました!']);
}
public function unlike(Request $request, Post $post)
{
    // いいねを削除
    $post->likes()->where('user_id',$request->user()->id)->delete();

    return response()->json(['message'=>'いいねを解除しました!']);
}
}