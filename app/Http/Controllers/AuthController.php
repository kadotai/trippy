<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            // バリデーション
            $request->validate([
                'username' => 'required|string|max:255',
                'user_icon' => 'nullable|image|max:2048',
                'sex' => 'required|in:male,female,unspecified',
                'birth' => 'required|numeric|min:1900|max:2024',
                'nationality' => 'required|string|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|confirmed|min:8',
            ]);
        
            // ユーザーアイコンの保存
            $iconPath = null;
            if ($request->hasFile('user_icon')) {
                $iconPath = $request->file('user_icon')->store('icons', 'public');
            }

            // ユーザー作成
            $user = User::create([
                'name' => $request->username,
                'user_icon' => $iconPath,
                'gender' => $request->sex,
                'birth' => $request->birth,
                'nationality' => $request->nationality,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);


            
            Auth::login($user); // 登録後に自動的にログイン
            $request->session()->regenerate(); // セッションを再生成

            // return redirect()->route('mypage');

        
            // 登録成功後、リダイレクト
            return redirect()->route('posts.top')->with('success', '登録が完了しました！');
        } catch (\Exception $e) {
            // dd($request->all());
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
        
    }

    // ログイン処理
    public function login(Request $request)
    {
        try {
            // バリデーション
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
            ]);
    
            // 認証試行
            if (Auth::attempt($credentials)) {
                // 認証成功
                $request->session()->regenerate();
                return redirect()->intended(route('posts.top'))->with('success', 'ログインしました！');
            }
    
            // 認証失敗
            return back()->withErrors([
                'email' => 'ログイン情報が正しくありません。',
            ]);
        } catch (\Exception $e) {
            // エラー発生時
            return back()->withErrors([
                'error' => 'エラーが発生しました: ' . $e->getMessage(),
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('welcome');
    }
}
