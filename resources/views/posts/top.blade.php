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
       <p class="tag">{{ 'キャニオニング' }}</p>
       <p class="tag">{{ '洞窟' }}</p>
       <p class="tag">{{ 'ビーチ' }}</p>
       <p class="tag">{{ 'ダイビング' }}</p>
     {{-- @endforeach --}}
</section>

{{-- 記事一覧nao --}}
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

</script>

</body>
</html>