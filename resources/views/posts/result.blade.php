<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>result|trippy</title>
    <link rel="stylesheet" href="{{ asset('assets/css/top.css') }}">
    @extends('layouts.original')
    @section('css')

</head>
<body>
    @section('content')
    {{-- 検索欄 --}}
    <section class="result_search">
        <div class="search">
            <form action="{{ route('posts.result') }}" method="GET">
                {{-- キーワード検索 --}}
                <input type="search" name="search" id="post_search" class="search_box" placeholder="投稿を検索">
                {{-- タグ --}}
                <section class="result_selected_tag">
                    <form action="{{ route('posts.result') }}" method="GET">
                        <p>タグを選択</p>
                    </form>
                    @foreach ($tags as $tag)
                    <p class="tag">{{ $tag->tag_name }}</p>
                    @endforeach
                </section>

                </select>
                <button type="submit" class="search_button">検索</button>
            </form>
        </div>
    </section>
    


    {{-- 検索結果の件数 --}}
    <section class="result_count">
        <p>検索結果: {{ $results->count() }} 件</p>
    </section>

    <section class="search_used_tags">
        @if(request()->has('search'))
            <p>{{ request('search') }}</p>
        @elseif(count($tags) > 0)
            <p>
                @foreach ($tags as $tag)
                    <span class="tag">{{ $tag->tag_name }}</span>
                @endforeach
            </p>
        @endif
    </section>

    {{-- 検索結果 --}}
    <section>
        <section class="result_posts">
            @foreach ($results as $post)
                <div class="post">
                    <h2>{{ $post->title }}</h2>
                    <p>{{ $post->content }}</p>
                    <p>タグ: 
                        @foreach ($post->tags as $tag)
                            <span class="tag">{{ $tag->tag_name }}</span>
                        @endforeach
                    </p>
                </div>
            @endforeach
        </section>
    </section>

    {{-- その他の記事のセクション --}}
    <section class="top_all_article_list">
        <div class="article_card"><a href="{{ route('posts.post') }}" class="article_card_link">
            <div class="article_card_left">
                <h1 class="username">Ryohey</h1>
                <img src="{{ asset('img/Morocco.jpg') }}" alt="旅行写真" class="travel_img">
            </div>
            <div class="article_card_right">
                <ul class="where">
                    <li class="country">Morocco</li>
                    <li class="city">&nbsp;Marrakesh</li>
                </ul>
                <p class="date">2024/11/12~2024/11/30</p>
                <p class="trip_title">モスク参拝</p>
                <p class="article_tag">#海</p>
                <div class="like_and_comment">
                    <div class="like">
                        <img src="{{ asset('img/like_icon.png') }}" alt="like" class="like_icon"><p class="like_number">111</p>
                    </div>
                    <div class="comment">
                        <img src="{{ asset('img/comment_icon.png') }}" alt="comment" class="comment_icon"><p class="comment_number">222</p>
                    </div>
                </div>
            </div>
        </a></div>
    </section>

    {{-- 他の記事 --}}
    <section class="top_all_article_list">
        <div class="article_card"><a href="{{ route('posts.post') }}" class="article_card_link">
            <div class="article_card_left">
                <h1 class="username">きぬえ</h1>
                <img src="{{ asset('img/Morocco.jpg') }}" alt="旅行写真" class="travel_img">
            </div>
            <div class="article_card_right">
                <ul class="where">
                    <li class="country">Egypt</li>
                    <li class="city">&nbsp;Cairo</li>
                </ul>
                <p class="date">2024/10/12~2024/10/20</p>
                <p class="trip_title">ピラミッド</p>
                <p class="article_tag">#海</p>
                <div class="like_and_comment">
                    <div class="like">
                        <img src="{{ asset('img/like_icon.png') }}" alt="like" class="like_icon"><p class="like_number">111</p>
                    </div>
                    <div class="comment">
                        <img src="{{ asset('img/comment_icon.png') }}" alt="comment" class="comment_icon"><p class="comment_number">222</p>
                    </div>
                </div>
            </div>
        </a></div>
    </section>

    {{-- 最後の記事 --}}
    <section class="top_all_article_list">
        <div class="article_card"><a href="{{ route('posts.post') }}" class="article_card_link">
            <div class="article_card_left">
                <h1 class="username">ザジー</h1>
                <img src="{{ asset('img/Morocco.jpg') }}" alt="旅行写真" class="travel_img">
            </div>
            <div class="article_card_right">
                <ul class="where">
                    <li class="country">India</li>
                    <li class="city">&nbsp;Calcutta</li>
                </ul>
                <p class="date">2024/12/10~2024/12/15</p>
                <p class="trip_title">ヨガ</p>
                <p class="article_tag">#海</p>
                <div class="like_and_comment">
                    <div class="like">
                        <img src="{{ asset('img/like_icon.png') }}" alt="like" class="like_icon"><p class="like_number">111</p>
                    </div>
                    <div class="comment">
                        <img src="{{ asset('img/comment_icon.png') }}" alt="comment" class="comment_icon"><p class="comment_number">222</p>
                    </div>
                </div>
            </div>
        </a></div>
    </section>
    @endsection
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
</body>
</
