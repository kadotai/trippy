<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('assets/css/mypage.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>
    {{-- ユーザー、アイコン --}}
    <div class="mypage-container">
        <section class="profile-section">
            <div class="profile">
                <img src="{{ $user->icon ? asset('storage/'.$user->icon) : asset('assets/images/default-icon.png') }}" alt="User Icon" class="profile-icon">
                <div class="small-profile">
                    <h2 class="username">{{ $user->name }}</h2>
                    <p class="visited-info">行った国: <strong></strong></p>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST" style="margin-top: 10px;">
                @csrf
                <a href="{{ route('myinfo') }}" class="edit-btn">edit profile</a>
                <button type="submit" class="logout-btn">ログアウト</button>
            </form>
        </section>
    </div>

    {{-- 国内外地図 --}}
    <div id="map-container">
        <div id="map-toggle">
            <span id="toggle-domestic">国内 /</span>
            <span id="toggle-overseas"> 海外</span>
        </div>
        <div id="my-map"></div>
        <div id="regions_div"></div>
    </div>

    {{-- タブヘッダー --}}
    <div class="tab-header">
        <button class="tab-btn active" data-tab="posts">投稿一覧</button>
        <button class="tab-btn" data-tab="planning">計画中</button>
        <button class="tab-btn" data-tab="likes">いいね</button>
    </div>

    {{-- タブコンテンツ --}}
    <div class="tab-content">
        {{-- 履歴 --}}
        <div class="tab-pane active" id="posts">
            <div class="post-list-container">
                @foreach ($posts as $post)
                    <div class="post-card clickable" data-route="{{ route('posts.post', $post->id) }}">
                        @foreach ($post->photos as $image) <!-- 投稿に関連する画像をループ -->
                            <img src="{{ asset('storage/' . $image->img) }}" alt="投稿画像" class="post-photo">
                        @endforeach
                        <div class="post-details">
                            <div class="title-wrapper">
                                <h2 class="title">タイトル名:{{ $post->title }}</h2>
                                <span class="status">公開中:{{ $post->is_public ? '公開' : '非公開' }}</span>
                            </div>
                            <p class="post-location">国:{{ $post->country->name }} / エリア: {{ $post->city }}</p>
                            <p class="post-date">年月日:{{ $post->start_date }}~{{ $post->end_date }}</p>
                            <p class="post-comment">コメント:{{ $post->content }}</p>
                            <div class="post-actions">
                                <button class="like-btn" data-post-id="{{ $post->id }}">
                                    @if ($post->likes()->where('user_id', auth()->id())->exists())
                                        ❤️
                                    @else
                                        🤍
                                    @endif
                                <span class="like-count">{{ $post->likes_count }}</span>
                                <button class="comment-btn">💬</button>
                                <button class="edit-btn clickable" data-route="{{ route('edit', $post->id) }}">編集</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- 計画中 --}}
        <div class="tab-pane" id="planning">
            <div class="post-list-container">
                @foreach ($plannedPosts as $plan)
                    <div class="post-card">
                        @foreach ($plan->photos as $photo)
                                <img src="{{ asset('storage/' . $photo->img) }}" alt="投稿画像" class="post-image">
                        @endforeach
                        <div class="post-details">
                            <h2 class="title">タイトル名:{{ $plan->title }}</h2>
                            <p class="post-location">国:{{ $plan->country->name }} / エリア: {{ $plan->city }}</p>
                            <p class="post-date">年月日:{{ $plan->start_date }}~{{ $plan->end_date }}</p>
                            <p class="post-comment">コメント:{{ $plan->content }}</p>
                            <button class="edit-btn clickable" data-route="{{ route('edit', $plan->id) }}">編集</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- 他人 --}}
        <div class="tab-pane" id="likes">
            <div class="post-list-container">
                @foreach ($likedPosts as $like)
                    <div class="post-card clickable" data-route="{{ route('posts.post', $like->id) }}">
                        <img src="{{ $like->images->first() ? asset('storage/'.$like->images->first()->image) : 'https://via.placeholder.com/80' }}" alt="投稿写真" class="post-photo">
                        <div class="post-details">
                            <h2 class="title">タイトル名:{{ $like->title }}</h2>
                            <div class="user-name-overlay">ユーザー名:{{ $like->user->name }}</div>
                            <p class="post-location">国:{{ $like->country->name }} / エリア:  {{ $like->city }}</p>
                            <p class="post-date">年月日:{{ $like->start_date }}~{{ $like->end_date }}</p>
                            <p class="post-comment">コメント:{{ $like->content }}</p>
                            <div class="post-actions">
                                <button class="like-btn" data-post-id="{{ $like->id }}">
                                    @if ($like->likes()->where('user_id', auth()->id())->exists())
                                        ❤️
                                    @else
                                        🤍
                                    @endif
                                </button>
                                <span class="like-count">{{ $like->likes_count}}</span>
                                <button class="comment-btn">💬</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- 地図のscriptタグ --}}
    {{-- <script type="text/javascript" src="https://unpkg.com/japan-map-js@1.0.1/dist/jpmap.min.js"></script>
    <script>
      fetch('/mypage', {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
      })
      .then(response => response.json())
      .then(prefectureIds => {
           var d = new jpmap.japanMap(document.getElementById("my-map"), {
            areas: Array.from({length:47}, (_, i) => ({
                code: i + 1,
                name: 'Prefecture ${i + 1}',
                color: prefectureIds.includes(i + 1) ? "#f8b500" : "#a0a0a0"
            })),
        
          showsPrefectureName: false,
          width: 410,
          movesIslands: true,
          borderLineColor: "#000000",
          lang: 'ja',
        });
    })
    .catch(error => console.error('Error fetching prefecture data:', error));
    </script> --}}

    {{-- 世界地図 --}}
    {{-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
    google.charts.load('current', {
        'packages':['geochart'],
      });
      google.charts.setOnLoadCallback(drawRegionsMap);

      function drawRegionsMap() {
        var data = google.visualization.arrayToDataTable([
          ['Country', 'Popularity'],
        ]);

        var options = {};

        var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

        chart.draw(data, options);
      }
      </script> --}}

      {{-- 地図のscriptタグ --}}
<script type="text/javascript" src="https://unpkg.com/japan-map-js@1.0.1/dist/jpmap.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
      // 日本地図描画関数
      function drawJapanMap(prefectureIds) {
          document.getElementById('my-map').innerHTML = ''; // リセット
          new jpmap.japanMap(document.getElementById("my-map"), {
              areas: Array.from({ length: 47 }, (_, i) => ({
                  code: i + 1,
                  name: `Prefecture ${i + 1}`,
                  color: prefectureIds.includes(i + 1) ? "#f8b500" : "#a0a0a0"
              })),
              showsPrefectureName: false,
              width: 410,
              movesIslands: true,
              borderLineColor: "#000000",
              lang: 'ja',
          });
      }

      // 初期設定：世界地図を表示
      google.charts.load('current', { 'packages': ['geochart'] });
      google.charts.setOnLoadCallback(drawRegionsMap);

      function drawRegionsMap() {
          var data = google.visualization.arrayToDataTable([
              ['Country', 'Popularity'],
              ['Japan', 100] // サンプルデータ
          ]);

          var options = {};
          var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));
          chart.draw(data, options);
      }

      // 都道府県データを取得し、日本地図を準備
      let prefectureIds = [];
      fetch('/mypage', {
          method: 'PATCH',
          headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
          }
      })
      .then(response => response.json())
      .then(data => {
          prefectureIds = data;
      })
      .catch(error => console.error('Error fetching prefecture data:', error));

      // 国内外の切り替えイベント
      document.getElementById('toggle-domestic').addEventListener('click', function() {
          document.getElementById('my-map').style.display = 'block';
          document.getElementById('regions_div').style.display = 'none';
          this.classList.add('active');
          document.getElementById('toggle-overseas').classList.remove('active');

          // 日本地図を再描画
          drawJapanMap(prefectureIds);
      });

      document.getElementById('toggle-overseas').addEventListener('click', function() {
          document.getElementById('my-map').style.display = 'none';
          document.getElementById('regions_div').style.display = 'block';
          this.classList.add('active');
          document.getElementById('toggle-domestic').classList.remove('active');
      });
  });
</script>



    <script src="{{ asset('assets/js/mypage.js') }}"></script>
</body>
</html>