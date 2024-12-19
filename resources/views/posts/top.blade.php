{{-- ヘッダーcana --}}
@extends('layouts.original')

@section('css')
<title>toppage|trippy</title>
<link rel="stylesheet" href="{{ asset('assets/css/top.css') }}">
@endsection

@section('content')

{{-- 検索ayaka --}}
<section class="top_search">
    <div class="search">
      <input type="search" id="post-search" class="search_box" placeholder="キーワードを入力(例:Cebu)">
      <button class="search_button" id="search_button">検索</button>
    </div>
</section>

{{-- タグayaka --}}
<section class="top_selected_tag">
       @foreach ($tags as $tag)
         <button class="tag-button" data-tag="{{ $tag->id }}">#{{ $tag ->tag_name }}</button>
     @endforeach
</section>

{{-- 記事一覧nao --}}
<section class="top_all_article_list">
    <div class="article_card">
        @foreach ($posts as $post)
        <a href="{{ route('posts.showPost',['id'=> $post->id]) }}" class="article_card_link">

        {{-- <a href="{{ route('posts.post') }}" class="article_card_link"> --}}
        <div class="article_card_left">
            <h1 class="username">{{ $post->user->name }}</h1>
        @if ($post->images->isNotEmpty()) 
        <img src="{{ asset('storage/' . $post->images->first()->img) }}" alt="旅行写真" class="travel_img">
    @else
        <img src="{{ asset('img/black_white_trippy.jpg') }}" alt="デフォルト画像" class="travel_img">
    @endif
        </div>
        <div class="article_card_right">
            <ul class="where">
                <li class="country">{{ $post->country->country_name }}</li>
                <li class="city">&nbsp;{{ $post->city }}</li>
            </ul>
            <p class="date">{{ $post->start_date }}~{{ $post->end_date }}</p>
            <p class="trip_title">{{ $post->title }}</p>
            {{-- <p class="article_tag" data-tag="{{ $tag->id }}">#{{ $tag ->tag_name }}</p> --}}

            <p class="article_result_tag">
                @foreach ($post->tags as $tag)
                    <span class="result_tag">#{{ $tag->tag_name }}</span>
                @endforeach
            </p>

            <div class="like_and_comment">
                <div class="like">
                    <img src="{{ asset('img/like_icon.png') }}" alt="like" class="like_icon"><p class="like_number">{{ $post->likes->count() }}</p>
                </div>
                <div class="comment">
                    <img src="{{ asset('img/comment_icon.png') }}" alt="comment" class="comment_icon"><p class="comment_number">{{ $post->comments->count() }}</p>
                </div>
            </div>
        </div>
    </a>
    @endforeach
    <div class="page">{{ $posts->links() }}</div>
</div>
</section>



{{-- タグ一覧のScriptタグ --}}
<script>
// タップ時の誤動作を防ぐためのスワイプ時の処理を実行しない最小距離
const minimumDistance = 30;

// スワイプ開始時の座標
let startX = 0;
let startY = 0;

// スワイプ対象のエリアを取得
const swipeArea = document.querySelector('.top_selected_tag');

// スワイプ開始時の処理
swipeArea.addEventListener('touchstart', (e) => {
  startX = e.touches[0].pageX;
  startY = e.touches[0].pageY;
});

// スワイプ終了時の処理
swipeArea.addEventListener('touchend', (e) => {
  const endX = e.changedTouches[0].pageX;
  const endY = e.changedTouches[0].pageY;

  // x軸とy軸の移動量を取得
  const distanceX = endX - startX;
  const distanceY = endY - startY;

  // 横方向のスワイプを検知
  if (Math.abs(distanceX) > Math.abs(distanceY) && Math.abs(distanceX) > minimumDistance) {
    if (distanceX > 0) {
      console.log('右スワイプ');
      // 右スワイプの処理
    } else {
      console.log('左スワイプ');
      // 左スワイプの処理
    }
  }
});


// 検索機能のscriptタグ----------------------
document.addEventListener("DOMContentLoaded", () => {
    const selectedTags = new Set();

    // タグ選択を管理
    document.querySelectorAll(".tag-button").forEach(button => {
        button.addEventListener("click", () => {
            const tagId = button.dataset.tagId;
            if (selectedTags.has(tagId)) {
                selectedTags.delete(tagId);
                button.classList.remove("selected");
            } else {
                selectedTags.add(tagId);
                button.classList.add("selected");
            }
        });
    });

    // 検索ボタンの動作
    document.getElementById("search_button").addEventListener("click", () => {
        const searchQuery = document.getElementById("post-search").value.trim();
        const tags = Array.from(selectedTags);

        // クエリパラメータを作成
        const queryParams = new URLSearchParams();
        if (searchQuery) queryParams.append("search", searchQuery);
        if (tags.length > 0) queryParams.append("tags", tags.join(","));

        // 検索結果ページにリダイレクト
        window.location.href = `/result?${queryParams.toString()}`;
    });
});


</script>
@endsection