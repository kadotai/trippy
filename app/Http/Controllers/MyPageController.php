<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
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

    // ビューにユーザー情報と訪問国数を渡す
    return view('posts.mypage', compact('user', 'visitedCountriesCount'));
    }

    public function getPrefectures(Request $request)
    {
        $user = Auth::user();

        $prefectureIds = Post::where('user_id', $user->id)
        ->pluck('prefecture_id');

        return response()->json($prefectureIds);
    }



}

