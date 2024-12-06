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
    <div class="tags">
        {{-- @foreach ($tags as $tag) --}}
          <p class="tag">{{ '国内旅行' }}</p>
          <p class="tag">{{ '海外旅行' }}</p>
          <p class="tag">{{ '傷心旅行' }}</p>
          <p class="tag">{{ '自分探し' }}</p>
        {{-- @endforeach --}}
    </div>


</section>

{{-- タグayaka --}}
<section class="top_selected_tag">


</section>

{{-- 記事一覧nao --}}
<section class="top_all_article_list">
    <div class="article_card">
        <div class="article_card_left">
            
        </div>
        <div class="article_card_right"></div>
    </div>

</section>

{{-- フッダーcana --}}

</body>
</html>