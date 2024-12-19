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

        // 訪問した国の数をカウントするロジック
        $visitedCountriesCount = DB::table('posts')
            ->where('user_id', $user->id)
            ->distinct('country_id') // ユニークな国をカウント
            ->count('country_id');

        // 訪問した国のリストを取得
        $visitedCountries = DB::table('posts')
            ->where('user_id', $user->id)
            ->join('countries', 'posts.country_id', '=', 'countries.id')
            ->distinct()
            ->pluck('countries.country_name');

        // ユーザーの投稿一覧
        $posts = Post::withCount('likes')
            ->with('images') // imagesも含めて取得
            ->where('user_id', $user->id)
            ->get();

        // 計画中の投稿一覧（post_typeがfalseのもの）
        $plannedPosts = Post::where('user_id', $user->id)
            ->where('post_type', false)
            ->get();

        // いいねした投稿一覧
        $likedPostIds = Like::where('user_id', $user->id)->pluck('post_id');
        $likedPosts = Post::whereIn('id', $likedPostIds)->get();

        // ビューにデータを渡す
        return view('posts.mypage', compact(
            'user',
            'posts',
            'plannedPosts',
            'likedPosts',
            'visitedCountriesCount',
            'visitedCountries'
        ));
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
