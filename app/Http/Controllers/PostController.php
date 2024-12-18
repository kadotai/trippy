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
use Illuminate\Support\Facades\Schema;

class PostController extends Controller
{
    // ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
public function showPost($id)
{
    $post = Post::Find($id);
    $routeData = json_decode($post->route_data, true);
    // routeDataがnullまたは空の場合、空の配列をセット
    if (is_null($routeData) || empty($routeData)) {
        $routeData = [];
    }
    return view('posts.post',['post'=>$post], compact('post', 'routeData'));
}
    // ↑↑↑↑↑↑↑↑↑↑↑↑↑
    
    public function show()
    {
        // 投稿と関連する画像を取得
        $posts = Post::with('photos')->get(); // Post モデルと関連する photos を取得

        // 計画中の投稿一覧も同様に取得
        $plannedPosts = Post::where('post_type', false)->with('photos')->get();

        // ビューに渡す
        return view('posts.post', compact('posts', 'plannedPosts'));

        $post = Post::find($id);

        return view('posts.show',['post'=>$post]);
    }

    public function index()
    {
        // $tags = Tag::all();
        // $posts = Post::all(); // データベースからすべての投稿を取得

        // $country = Post::with('country')->get();
        // return view('posts.top', compact('tags', 'posts'));

        $tags = Tag::all();

    // 新しい順に10件の投稿を取得し、関連データも一緒にロードする
    $posts = Post::with(['user', 'images', 'country'])
                ->orderBy('updated_at', 'desc') // 新しい順に並び替え
                ->paginate(10); // ページネーションで10件ずつ取得
                // ->take(10)                     // 10件のみ取得
                // ->get();

    return view('posts.top', compact('tags', 'posts'));

    }

    public function create()
    {
        $countries = Country::all(); // 国データを取得
        $tags = Tag::all();
        return view('posts.create', compact('countries', 'tags'));
    }

    public function store(Request $request)
    {
        try{
        //デバッグ用↓
        // dd($request->all());

         // **バリデーション**
    $request->validate([
        'title' => 'nullable|string|max:255',
        'country' => 'required|exists:countries,country_name',
        'city' => 'nullable|string|max:255',
        'start_date' => 'nullable|date',
        'end_date' => 'nullable|date',
        'tags' => 'nullable|array',
        'tags.*' => 'exists:tags,id',
        'images' => 'nullable|array',
        'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'route_data' => 'nullable|json',
        'duration' => 'nullable|string',
    ]);
    
    // **国のIDを取得**
    $country = Country::where('country_name', $request->input('country'))->first();

    // **posts テーブルに保存**
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

    // dd($request);

    // **post_images テーブルに画像を保存**
    if ($request->hasFile('images') && is_array($request->file('images'))) {
        foreach ($request->file('images') as $image) {
            $path = $image->store('img', 'public'); // `storage/app/public/images/` に保存
            Post_image::create([
                'post_id' => $post->id,
                'img' => $path,
            ]);
        }
    }

    // **post_tags テーブルにタグを保存**
    if ($request->has('tags')) {
        foreach ($request->input('tags') as $tagId) {
            Post_tag::create([
                'post_id' => $post->id,
                'tag_id' => $tagId,
            ]);
        }
    }

    // 完了後のリダイレクト
    return redirect()->route('posts.create')->with('success', '投稿が保存されました。');
} catch (\Throwable $e) {
    // 開発中のみエラーメッセージを表示
    if (app()->environment('local')) {
        return response()->json([
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
            'data' => $request->all(),
        ], 500);
    }

    // 本番環境ではログに記録して一般的なエラーを表示
    \Log::error('システムエラー: ', [
        'message' => $e->getMessage(),
        'trace' => $e->getTraceAsString(),
        'request_data' => $request->except(['images']),
    ]);
    return redirect()->back()->withInput()->withErrors(['error' => '予期しないエラーが発生しました。再度お試しください。']);
}
}

    public function showResults(Request $request)
    {
        $posts = Post::with(['country', 'user'])->get();

        $searchQuery = $request->query('search'); // 検索キーワード
        $selectedTags = $request->query('tags'); // 選択されたタグ（カンマ区切り）

        $selectedTagsArray = $selectedTags ? explode(',', $selectedTags) : [];

        //タグ一覧を取得
        $tags = Tag::all();

        // データベース検索処理
        $results = Post::query()
            ->when($searchQuery, function ($query) use ($searchQuery) {
                //カラム一覧を取得
                $columns = Schema::getColumnListing('posts');

                //カラムごとに検索条件を追加
                $query->where(function ($q) use ($columns, $searchQuery) {
                    foreach ($columns as $column) {
                        $q->orWhere($column, 'LIKE', "%{$searchQuery}%");
                    }
                });
            })
            ->when(!empty($selectedTagsArray), function ($query) use ($selectedTagsArray) {
                return $query->whereHas('tags',function($subQuery) use ($selectedTagsArray){
                    $subQuery->whereIn('tags.id', $selectedTagsArray);
                });
            })
            ->get();

$posts = Post::withCount('comments')->get();
$posts = Post::withCount('likes')->get();
        return view('posts.result', compact('results', 'searchQuery', 'selectedTagsArray', 'tags','posts')); 
    }

    public function result(Request $request)
    {
    
    $search = $request->input('search');
    $tagId = $request->input('tag_id'); // タグIDを取得
    $query = Post::query();

    // 検索キーワードが入力されている場合のみ条件を追加
    if ($request->has('search') && !empty($request->input('search'))) {
        $keyword = $request->input('search');
        $query->where('title', 'LIKE', "%{$keyword}%")
                ->orWhere('content', 'LIKE', "%{$keyword}%");
    }

    // 検索結果を取得
    $results = $query->get();
    $tags = Tag::all();

    return view('posts.result', compact('results', 'tags'));

}
    public function edit($id)
    {
    $post = Post::with('tags', 'photos')->findOrFail($id);
    $countries = Country::all();
    $tags = Tag::all();
    return view('posts.edit', compact('post', 'countries', 'tags'));

    // $post = Post::find($id);

    // return view('posts.edit',['post'=> $post]);
}

public function update(Request $request, $id)
{
    $post = Post::findOrFail($id);

    // 入力データの検証
    $request->all();
    
    // validate([
    //     'title' => 'required|string|max:255',
    //     'start_date' => 'required|date',
    //     'end_date' => 'required|date|after_or_equal:start_date',
    //     // 他の検証ルールを追加
    // ]);

    // データ更新
    $post->update($request->all());

    // タグの更新
    if ($request->has('tags')) {
        $post->tags()->sync($request->input('tags'));
    }

    return redirect()->route('posts.index')->with('success', '投稿が更新されました！');
// }一旦ねnao
    }


public function search(Request $request)
{
    $query = Post::query();

    if ($request->has('search')) {
        $query->where('title', 'like', '%' . $request->input('search') . '%')
              ->orWhere('content', 'like', '%' . $request->input('search') . '%');
    }

    if ($request->has('tags')) {
        $tags = explode(',', $request->input('tags'));
        $query->whereHas('tags', function ($query) use ($tags) {
            $query->whereIn('id', $tags);
        });
    }

    $posts = $query->get();

    return response()->json($posts);
}

}
