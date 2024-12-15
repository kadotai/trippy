<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // 編集画面を表示するメソッド（表示専用の画面は不要）
    public function edit()
    {
        $user = Auth::user();

        if (!$user) {
            // 未ログインの場合、ログイン画面にリダイレクト
            return redirect()->route('login')->with('error', 'ログインしてください。');
        }

        // 編集画面を表示する
        return view('auth.myinfo', ['user' => $user]);
    }

    // プロフィールを更新するメソッド
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
            'password' => 'nullable|min:8|confirmed',
            'icon' => 'nullable|image|max:2048' // 最大2MBの画像
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        if ($request->hasFile('icon')) {
            // 古いアイコンの削除
            if ($user->icon && \Storage::disk('public')->exists($user->icon)) {
                \Storage::disk('public')->delete($user->icon);
            }

            // 新しいアイコンの保存
            $path = $request->file('icon')->store('icons', 'public');
            $user->icon = $path;
        }

        $user->save();

        return redirect()->route('myinfo.edit')->with('success', 'プロフィールを更新しました！');
    }
}
