<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>result|trippy</title>
        @extends('layouts.original')
        @section('css')
        <link rel="stylesheet" href="{{ asset('assets/css/top.css') }}">
        @endsection
    </head>
    <body>
        @section('content')
        {{-- 検索欄 --}}
        <section class="result_search">
            <div class="search">
                <form action="{{ route('posts.result') }}" method="GET">
                    {{-- キーワード検索 --}}
                    <input type="search" name="search" 
                    id="post_search" class="search_box" placeholder="投稿を検索" 
                    value="{{ request('search') }}">
                    <input type="hidden" name="tags" id="selected-tags">
                    <button type="submit" class="search_button">検索</button>
                </form>
            </div>
        </section>

        {{-- タグ --}}
        <section class="result_selected_tag">
            @foreach ($tags as $tag)
                <button class="tag-button-result" data-tag-result="{{ $tag->id }}">#{{ $tag->tag_name }}</button>
            @endforeach
        </section>

        {{-- 検索結果の件数 --}}
        <section class="result_count">
            <p>Search Results: {{ $results->count() }} Post</p>
        </section>
    
        {{-- 検索結果 --}}
        @if ($results->count() > 0)
    @foreach ($results as $post)
        <div class="article_card_result" data-id="{{ $post->id }}">
            <a href="{{ route('posts.showPost',['id'=> $post->id]) }}" class="article_card_link">
                <div class="article_card_left">
                    <h1 class="username">{{ $post->user->name }}</h1>
                    @if ($post->images->isNotEmpty())
                        <img src="{{ asset('storage/' . $post->images->first()->img) }}" alt="旅行写真" class="travel_img">
                    @else
                        <img src="{{ asset('img/default_image.jpg') }}" alt="デフォルト画像" class="travel_img">
                    @endif
                </div>
                <div class="article_card_right">
                    <ul class="where">
                        <li class="country">{{ $post->country->country_name ?? 'Country not found' }}</li>
                        <li class="city">&nbsp;{{ $post->city }}</li>
                    </ul>
                    <p class="date">{{ $post->start_date }}~{{ $post->end_date }}</p>
                    <p class="trip_title">{{ $post->title }}</p>
                    <p class="article_result_tag">
                        @foreach ($post->tags as $tag)
                            <span class="result_tag">#{{ $tag->tag_name }}</span>
                        @endforeach
                    </p>
                    <div class="like_and_comment">
                        <div class="like">
                            <img src="{{ asset('img/like_icon.png') }}" alt="like" class="like_icon">
                            <p class="like_number">{{ $post->likes->count() }}</p>
                        </div>
                        <div class="comment">
                            <img src="{{ asset('img/comment_icon.png') }}" alt="comment" class="comment_icon">
                            <p class="comment_number">{{ $post->comments->count() }}</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
@else
    <p>No matching posts.</p>
@endif
        @endsection



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

    document.addEventListener('DOMContentLoaded', () => {
    const tagButtons = document.querySelectorAll('.tag-button-result');
    if (tagButtons.length === 0) {
        console.log("タグボタンが見つかりません！");
    } else {
        console.log(tagButtons); // ボタンがあるか再確認
    }
});
    </script>
</body>
</html>
