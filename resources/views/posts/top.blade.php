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
    <input type="search" id="post-search">
    <button>検索</button>
    <div class="tags">
        {{-- @foreach ($tags as $tag) --}}
          <p class="tag">{{ '国内旅行' }}</p>
        {{-- @endforeach --}}
    </div>


</section>

{{-- タグayaka --}}
<section class="top_selected_tag">


</section>

{{-- 記事一覧nao --}}
<section class="top_all_article_list"><a href="">
    <div class="article_card">
        <div class="article_card_left">
            <p class="username">Ryohey</p>
            <img src="" alt="旅行写真">
        </div>
        <div class="article_card_right">
            <p class="country">Morocco</p>
            <p class="city">Marrakesh</p>
            <p class="date">2024/11/12~2024/11/30</p>
            <p class="article_tag">#海</p>
            <div class="like_and_comment">
                <img src="{{ asset('img/like_icon.png') }}" alt="like"><p class="like">111</p>
                <img src="{{ asset('img/comment_icon.png') }}" alt="comment"><p class="comment">222</p>
            </div>

        </div>
    </div>
</a></section>

{{-- フッダーcana --}}

</body>
</html>