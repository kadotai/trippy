<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggleLike(Post $post)
    {
        $user = Auth::user();
    
        // すでにいいねしているか確認
        $like = Like::where('post_id', $post->id)->where('user_id', $user->id)->first();
    
        if ($like) {
            // いいねを削除
            $like->delete();
            $liked = false;
        } else {
            // いいねを作成
            Like::create([
                'post_id' => $post->id,
                'user_id' => $user->id,
            ]);
            $liked = true;
        }
    
        // 更新後のいいね数と状態を返す
        return response()->json([
            'likes_count' => $post->likes()->count(),
            'liked' => $liked,
        ]);

        return response()->json(['message' => 'いいねしました!']);
    }


public function unlike(Request $request, Post $post)
{
    // いいねを削除
    $post->likes()->where('user_id',$request->user()->id)->delete();

    return response()->json(['message'=>'いいねを解除しました!']);
}
}