<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Like;
use Illuminate\Support\Facades\DB;

class MyPageController extends Controller
{
    public function show()
    {
        // 現在ログインしているユーザーを取得
    $user = Auth::user();

    if (!$user) {
        // ユーザーが未ログインの場合はログイン画面へリダイレクト
        return redirect()->route('login')->with('error', 'ログインしてください。');
    }

    // 訪問した国の数をカウントするロジック（例: visited_countries テーブルに基づく）
    $visitedCountriesCount = DB::table('posts')
        ->where('user_id', $user->id)
        ->distinct('country_id')
        ->count();

                // ユーザーの投稿一覧
                $posts = Post::with(['images']) // imagesリレーションを取得
                ->withCount('likes') // likesリレーションの件数をカウント
                ->where('user_id', $user->id) // 特定のユーザーの投稿に絞り込み
                ->get();

                // 計画中の投稿一覧（post_typeがfalseのもの）
                $plannedPosts = Post::where('user_id', $user->id)->where('post_type', false)->get();
                // dd($posts);

                // いいねした投稿一覧
                $likedPostIds = Like::where('user_id', $user->id)->pluck('post_id');
                $likedPosts = Post::whereIn('id', $likedPostIds)->get();
                
        // ビューにユーザー情報を渡す
        return view('posts.mypage', compact('user', 'posts', 'plannedPosts', 'likedPosts', 'visitedCountriesCount'));
    }

    public function getPrefectures(Request $request)
    {
        $user = Auth::user();

        $prefectureIds = Post::where('user_id', $user->id)
        ->pluck('prefecture_id');

        return response()->json($prefectureIds);
    }


    public function edit($id)
{
    // ユーザーがログインしているか確認
    $user = Auth::user();

    if (!$user) {
        return redirect()->route('login')->with('error', 'ログインしてください。');
    }

    // 指定されたIDの投稿を取得
    $post = Post::where('user_id', $user->id)->where('id', $id)->first();

    if (!$post) {
        return redirect()->route('mypage')->with('error', '投稿が見つかりません。');
    }

    // 編集画面に投稿データを渡す
    return view('posts.edit', compact('post'));
}
}

