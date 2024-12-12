<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        
        // ビューにユーザー情報を渡す
        return view('posts.mypage', compact('user'));
    }
}
