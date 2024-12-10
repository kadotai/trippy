<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
            User::create([
                'name' => $request->username,
                'icon' => $iconPath,
                'gender' => $request->sex,
                'birth' => $request->birth,
                'nationality' => $request->nationality,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // dd($request->all());

        
            // 登録成功後、リダイレクト
            return redirect()->route('posts.top')->with('success', '登録が完了しました！');
        } catch (\Exception $e) {
            // dd($request->all());
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
        
    }
}
