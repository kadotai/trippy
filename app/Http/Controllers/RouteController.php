<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class RouteController extends Controller
{
    //↓これ今ルートから外したから使ってないことになってるはず：太田
    public function store(Request $request)
    {
        $validated = $request->validate([
            'route_data' => 'required|json',
            'distance' => 'required|numeric',
            'duration' => 'required|numeric'
        ]);

        // データを保存
        Post::create([
            'route_data' => $validated['route_data'],
            'distance' => $validated['distance'],
            'duration' => gmdate("H:i:s", $validated['duration']) // 秒からTIME型に変換
        ]);

        return response()->json(['message' => 'ルートデータが保存されました！'], 201);
    }
}
