<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller
{
    public function create($post_id)
    {
        $post =Post::find($post_id);
        return view("posts.post",["post" =>$post]);
    }
    public function store(Request $request)
    {
        // バリデーション
        $validatedData = $request->validate([
            'comment' => 'required|string|max:500', // コメントが必須で最大500文字
            'post_id' => 'required|exists:posts,id', // 有効な投稿ID
        ]);
    
        // コメントをデータベースに保存
        $comment = new Comment;
        $comment->comment = $request->comment;
        $comment->user_id = Auth::id();
        $comment->post_id = $request->post_id;
        $comment->save();
    
        // 投稿データを取得
        $post = Post::find($request->post_id);

         // もし$postにroute_dataがあれば、$routeDataをセット
        $routeData = json_decode($post->route_data, true);

        // routeDataがnullまたは空の場合、空の配列をセット
        if (is_null($routeData) || empty($routeData)) {
        $routeData = [];
    }
    
        // `posts.post` ビューを返す
        return view('posts.post', ['post' => $post, 'routeData' => $routeData])
            ->with('success', 'コメントを投稿しました！');
    }

    
    public function destroy($id)
    {
        $comment = Comment::find($id);

        // コメントが存在するか確認
        if (!$comment) {
            return redirect()->back()->with('error', 'コメントが見つかりません。');
        }

        // ログインユーザーがコメントの所有者か確認
        if ($comment->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'このコメントを削除する権限がありません。');
        }

        // コメントを削除
        $comment->delete();

        // 投稿データを取得
        $post = Post::find($comment->post_id);

        // もし$postにroute_dataがあれば、$routeDataをセット
        $routeData = json_decode($post->route_data, true);
    
        // routeDataがnullまたは空の場合、空の配列をセット
        if (is_null($routeData) || empty($routeData)) {
        $routeData = [];
        }

        // 投稿を表示するビューに$postと$routeDataを渡す
        return view('posts.post', ['post' => $post, 'routeData' => $routeData])
        ->with('success', 'コメントを削除しました。');
        }
}






//     public function store(Request $request)
//     {
//         $validatedData = $request->validate([
//             'comment' => 'required|string|max:500', // コメントが必須で最大500文字
//             'post_id' => 'required|exists:posts,id', // 有効な投稿ID
//         ]);
    
//         $post = Post::find($request->post_id);
//         $comment = new Comment;
//         $comment -> comment = $request -> comment;
//         $comment -> user_id = Auth::id();
//         $comment -> post_id = $request -> post_id;
//         $comment -> save();
        
//         //return view("posts.show",["post" =>$post]);
//         return redirect()->route("posts.post",$post->id);
//     }
// }


