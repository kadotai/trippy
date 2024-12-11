<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Show the user's mypage.
     */
    public function show()
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'ログインが必要です');
        }
        
        // 現在ログインしているユーザー情報を取得
        $user = Auth::user();

        // ユーザー情報をビューに渡す
        return view('posts.mypage', compact('user'));
    }
}
