<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Post;
use App\Models\Prefecture;



class PostController extends Controller
{
    public function show()
    {
        // 投稿を取得
    $posts = Post::with('photos')->get(); // Post モデルと関連する photos を取得

    // ビューに渡す
    return view('posts.post', compact('posts'));
    }

    public function index()
    {
        $tags = Tag::all();
        return view('posts.top', compact('tags'));

        $posts = Post::all(); // データベースからすべての投稿を取得
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        // return view('posts.create');

        $prefectures = Prefecture::all(); // 都道府県データを取得
        $tags = Tag::all();
        return view('posts.create', compact('prefectures','tags'));


    }

    function store(Request $request)
    {
        // フォームからのデータを検証します
        $validatedData = $request->validate([
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'required|string|max:255',
            'country' => 'required|string|size:2',
            'city' => 'required|string|max:255',
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'content' => 'required|string',
            'post_type' => 'required|in:public,private',
        ]);

        $request->validate([
            'route_date' => 'nullable|string',
            'duration' => 'nullable|string',
        ]);

        // 写真を保存
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
        }

        // データベースに保存
        $post = new Post();
        $post->user_id = auth()->id(); // ログインしているユーザーのID
        $post->title = $validatedData['title'];
        $post->country = $validatedData['country'];
        $post->city = $validatedData['city'];
        $post->start_date = $validatedData['start_date'];
        $post->end_date = $validatedData['end_date'];
        $post->content = $validatedData['content'];
        $post->route_data = json_encode([]); // 空のデータで初期化
        $post->distance = 0;
        $post->duration = 0;
        $post->post_type = $validatedData['post_type'];
        $post->save();

        // 画像がある場合、別テーブルに保存
        if ($photoPath) {
            $post->images()->create([
                'img' => $photoPath,
            ]);
        }

        return redirect()->back()->with('success', '投稿が保存されました！');

        // 入力データのバリデーション
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'country' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'content' => 'nullable|string',
    ]);

    // データを保存
    Post::create($validated);

    // フォームに戻る（入力内容を保持）
    return redirect()
        ->route('posts.create') // フォームページにリダイレクト
        ->withInput() // 入力値を保持
        ->with('success', '投稿が保存されました！'); // 成功メッセージ

        $request->validate([
            'route_date' => 'nullable|string',
            'duration' => 'nullable|string',
        ]);
    }

    public function showResults(Request $request)
    {


        // $posts = Post::with('country')->get();


// postsテーブルからすべてのデータを取得
        // $posts = Post::all();
    //Usersテーブルからユーザーネームを取得
        $posts = Post::with('user')->get();
        


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

        return view('posts.result', compact('results', 'searchQuery', 'selectedTagsArray', 'tags','posts')); 
   
           
    }
// //12/12 cana
//     public function showResult($id)
//     {
//         $post = Post::find($id); //指定したidの投稿を取得
//         $images = $post->images; //投稿に関する画像を取得
//         return view('posts.result',compact('post','images')); //ビューにデータを渡して表示
//     }
   

    
    // public function showPosts()
    // {
    // $posts = Post::with('images')->get(); // Postと関連する画像を取得

    // return view('posts.result', compact('posts'));
    // }
}



// public function result()
//     {
        // // postsテーブルからすべてのデータを取得
        // $posts = Post::all();
        // // dd($posts);
        // // ビューにデータを渡して表示
        // return view('posts.result', compact('posts'));
    // }
