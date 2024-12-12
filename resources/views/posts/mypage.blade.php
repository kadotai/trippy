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
                    <p class="visited-info">行った都道府県: <strong></strong> / 国: <strong></strong></p>
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
    <div id="my-map"></div>

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
                <div class="post-card clickable" data-route="/details/1">
                <img src="https://via.placeholder.com/80" alt="投稿写真" class="post-photo">
                    <div class="post-details">
                        <div class="title-wrapper">
                            <h2 class="title">タイトル名</h2>
                            <span class="status">公開中</span>
                        </div>
                        <p class="post-location">国: 日本 / エリア: 東京</p>
                        <p class="post-date">2024年12月3日</p>
                        <p class="post-comment">これはサンプルコメントです。</p>
                        <div class="post-actions">
                            <button class="like-btn">🤍</button>
                            <span class="like-count">0</span>
                            <button class="comment-btn">💬</button>
                            <button class="edit-btn clickable" data-route="/edit/1">編集</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- 計画中 --}}
        <div class="tab-pane" id="planning">
            <div class="post-list-container">
                <div class="post-card">
                <img src="https://via.placeholder.com/80" alt="投稿写真" class="post-photo">
                    <div class="post-details">
                        <h2 class="title">タイトル名</h2>
                        <p class="post-location">国: 日本 / エリア: 大阪</p>
                        <p class="post-date">2024年12月5日</p>
                        <p class="post-comment">これは計画中のサンプルコメントです。</p>
                        <button class="edit-btn clickable" data-route="/edit/2">編集</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- 他人 --}}
        <div class="tab-pane" id="likes">
            <div class="post-list-container">
                <div class="post-card clickable" data-route="/details/3">
                <img src="https://via.placeholder.com/80" alt="投稿写真" class="post-photo">
                    <div class="post-details">
                        <h2 class="title">タイトル名</h2>
                        <div class="user-name-overlay">ユーザー名</div>
                        <p class="post-location">国: 日本 / エリア: 京都</p>
                        <p class="post-date">2024年12月3日</p>
                        <p class="post-comment">これはいいねした投稿のコメントです。</p>
                        <div class="post-actions">
                            <button class="like-btn">🤍</button>
                            <span class="like-count">0</span>
                            <button class="comment-btn">💬</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- 地図のscriptタグ --}}
    <script type="text/javascript" src="https://unpkg.com/japan-map-js@1.0.1/dist/jpmap.min.js"></script>
    <script type="text/javascript" src="dist/jpmap.min.js"></script>
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
    </script>
    <script src="{{ asset('assets/js/mypage.js') }}"></script>
</body>
</html>