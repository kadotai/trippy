<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>toppage|trippy</title>
    <link rel="stylesheet" href="{{ asset('assets/css/top.css') }}">
</head>
<body>
{{-- ヘッダーcana --}}

{{-- 検索ayaka --}}
<section class="top_search">
    <div class="search">
      <input type="search" id="post-search" class="search_box">
      <button class="search_button">検索</button>
    </div>
</section>

{{-- タグayaka --}}
<section class="top_selected_tag">
       {{-- @foreach ($tags as $tag) --}}
       <p class="tag">{{ '国内旅行' }}</p>
       <p class="tag">{{ '海外旅行' }}</p>
       <p class="tag">{{ '傷心旅行' }}</p>
       <p class="tag">{{ '自分探し' }}</p>
     {{-- @endforeach --}}
</section>

{{-- 記事一覧nao --}}
<section class="top_all_article_list">
    <div class="article_card"><a href="{{ route('posts.post') }}" class="article_card_link">
        <div class="article_card_left">
            <h1 class="username">Ryohey</h1>
            <img src="" alt="旅行写真" class="travel_img">
        </div>
        <div class="article_card_right">
            <ul class="where">
                <li class="country">Morocco</li>
                <li class="city">&nbsp;Marrakesh</li>
            </ul>
            <p class="date">2024/11/12~2024/11/30</p>
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

{{-- フッダーcana --}}

</body>
</html>