<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Post;

class PostController extends Controller
{
    public function show()
    {
        return view('posts.post');
    }

    public function index()
    {
        $tags = Tag::all();
        return view('posts.top', compact('tags'));
    }

    public function showResults(Request $request)
    {
        $searchQuery = $request->query('search'); // 検索キーワード
        $selectedTags = $request->query('tags'); // 選択されたタグ（カンマ区切り）

        $selectedTagsArray = $selectedTags ? explode(',', $selectedTags) : [];

        //タグ一覧を取得
        $tags = Tag::all();

        // データベース検索処理
        $results = Post::query()
            ->when($searchQuery, function ($query) use ($searchQuery) {
                return $query->where('title', 'LIKE', "%{$searchQuery}%");
            })
            ->when(!empty($selectedTagsArray), function ($query) use ($selectedTagsArray) {
                return $query->whereHas('tags',function($subQuery) use ($selectedTagsArray){
                    $subQuery->whereIn('tags.id', $selectedTagsArray);
                });
            })
            ->get();

        return view('posts.result', compact('results', 'searchQuery', 'selectedTagsArray', 'tags')); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'route_date' => 'nullable|string',
            'duration' => 'nullable|string',
        ]);
    }
}

