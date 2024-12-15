<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Post;
use App\Models\Country;
use App\Models\Post_image;
use App\Models\Post_tag;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function show()
    {
        // 投稿と関連する画像を取得
        $posts = Post::with('photos')->get(); // Post モデルと関連する photos を取得

        // 計画中の投稿一覧も同様に取得
        $plannedPosts = Post::where('post_type', false)->with('photos')->get();

        // ビューに渡す
        return view('posts.post', compact('posts', 'plannedPosts'));
    }

    public function index()
    {
        $tags = Tag::all();
        return view('posts.top', compact('tags'));
    }

    public function create()
    {
        $countries = Country::all(); // 国データを取得
        $tags = Tag::all();
        return view('posts.create', compact('countries', 'tags'));
    }

    public function store(Request $request)
    {
         // **1. バリデーション**
    $request->validate([
        'title' => 'nullable|string|max:255',
        'country' => 'required|exists:countries,country_name',
        'city' => 'nullable|string|max:255',
        'start_date' => 'nullable|date',
        'end_date' => 'nullable|date',
        'tags' => 'nullable|array',
        'tags.*' => 'exists:tags,id',
        'img' => 'nullable|array',
        'img.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        'route_data' => 'nullable|array',
        'duration' => 'nullable|string',
    ]);

    // **2. 国のIDを取得**
    $country = Country::where('country_name', $request->input('country'))->first();

    // **3. posts テーブルに保存**
    $post = Post::create([
        'user_id' => auth()->id(),
        'country_id' => $country->id,
        'title' => $request->input('title'),
        'city' => $request->input('city'),
        'start_date' => $request->input('start_date'),
        'end_date' => $request->input('end_date'),
        'content' => $request->input('caption'),
        'route_data' => json_encode($request->input('route_data')),
        'duration' => $request->input('duration'),
        'post_type' => $request->input('open') === 'public',
    ]);

    // **4. post_images テーブルに画像を保存**
    if ($request->has('img')) {
        foreach ($request->file('img') as $image) {
            $path = $image->store('images', 'public'); // `storage/app/public/images/` に保存
            Post_image::create([
                'post_id' => $post->id,
                'img' => $path,
            ]);
        }
    }

    // **5. post_tags テーブルにタグを保存**
    if ($request->has('tags')) {
        foreach ($request->input('tags') as $tagId) {
            Post_tag::create([
                'post_id' => $post->id,
                'tag_id' => $tagId,
            ]);
        }
    }

    // **6. 完了後のリダイレクト**
    return redirect()->route('posts.create')->with('success', '投稿が保存されました。');
    //     // フォームからのデータを検証します
    //     $validatedData = $request->validate([
    //         'img.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    //         'title' => 'required|string|max:255',
    //         'country' => 'required|string|size:2',
    //         'city' => 'required|string|max:255',
    //         'start_date' => 'required|date|before_or_equal:end_date',
    //         'end_date' => 'required|date|after_or_equal:start_date',
    //         'content' => 'required|string',
    //         'post_type' => 'required|in:public,private',
    //     ]);

    //     // 写真を保存
    //     $photoPath = null;
    //     if ($request->hasFile('photo')) {
    //         $photoPath = $request->file('photo')->store('photos', 'public');
    //     }

    //     // データベースに保存
    //     $post = new Post();
    //     $post->user_id = auth()->id(); // ログインしているユーザーのID
    //     $post->title = $validatedData['title'];
    //     $post->country = $validatedData['country'];
    //     $post->city = $validatedData['city'];
    //     $post->start_date = $validatedData['start_date'];
    //     $post->end_date = $validatedData['end_date'];
    //     $post->content = $validatedData['content'];
    //     $post->route_data = json_encode([]); // 空のデータで初期化
    //     $post->distance = 0;
    //     $post->duration = 0;
    //     $post->post_type = $validatedData['post_type'];
    //     $post->save();

    //     // 画像がある場合、別テーブルに保存
    //     if ($photoPath) {
    //         $post->images()->create([
    //             'img' => $photoPath,
    //         ]);
    //     }

    //     return redirect()->back()->with('success', '投稿が保存されました！');
    // }

    // public function showResults(Request $request)
    // {
    //     $posts = Post::with('country')->get();
    //     $posts = Post::with('user')->get();

    //     $searchQuery = $request->query('search'); // 検索キーワード
    //     $selectedTags = $request->query('tags'); // 選択されたタグ（カンマ区切り）

    //     $selectedTagsArray = $selectedTags ? explode(',', $selectedTags) : [];

    //     //タグ一覧を取得
    //     $tags = Tag::all();

    //     // データベース検索処理
    //     $results = Post::query()
    //         ->when($searchQuery, function ($query) use ($searchQuery) {
    //             return $query->where('title', 'LIKE', "%{$searchQuery}%");
    //         })
    //         ->when(!empty($selectedTagsArray), function ($query) use ($selectedTagsArray) {
    //             return $query->whereHas('tags',function($subQuery) use ($selectedTagsArray){
    //                 $subQuery->whereIn('tags.id', $selectedTagsArray);
    //             });
    //         })
    //         ->get();

    //     return view('posts.result', compact('results', 'searchQuery', 'selectedTagsArray', 'tags', 'posts')); 
    }
}