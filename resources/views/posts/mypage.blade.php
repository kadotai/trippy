<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('assets/css/mypage.css') }}">
</head>
<body>
    {{-- ユーザー、アイコン --}}
    <div class="mypage-container">
        <section class="profile-section">
            <div class="profile">
                <img src="" alt="User Icon" class="profile-icon">
                <div class="small-profile">
                    <h2 class="username">名前</h2>
                    <p class="visited-info">行った都道府県: <strong></strong> / 国: <strong></strong></p>
                </div>
            </div>
            <a href="{{ route('myinfo') }}" class="edit-btn">edit profile</a>
        </section>
    </div>

    {{-- 国内外地図 --}}
    <div id="my-map-jp">地図</div>

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
        var d = new jpmap.japanMap(document.getElementById("my-map"), {
          width: 500, //横幅のサイズ
          movesIslands: true, //沖縄地方が地図の左上の分離されたスペースに移動する
        });
    </script>
    <script>
        var areaLinks = {
                         1:"https://www.pref.hokkaido.lg.jp/",　//リンク先URL
                         2:"https://www.pref.aomori.lg.jp/",
        　　　　　　　　　 3:"https://www.pref.iwate.lg.jp/",
                         4:"https://www.pref.miyagi.lg.jp/",
                                    ・
                                    ・
                                　　省略
                                    ・
                                    ・
                };
        
        var d = new jpmap.japanMap(document.getElementById("my-map"), {
            areas: [
            {code : 1, name: "北海道", color: "#7f7eda", hoverColor: "#b3b2ee"},
            {code : 2, name: "青森", color: "#759ef4", hoverColor: "#98b9ff"},
            {code : 3, name: "岩手", color: "#759ef4", hoverColor: "#98b9ff"},
            {code : 4, name: "宮城", color: "#759ef4", hoverColor: "#98b9ff"},
            {code : 5, name: "秋田", color: "#759ef4", hoverColor: "#98b9ff"},
            {code : 6, name: "山形", color: "#759ef4", hoverColor: "#98b9ff"},
            {code : 7, name: "福島", color: "#759ef4", hoverColor: "#98b9ff"},
            {code : 8, name: "茨城", color: "#7ecfea", hoverColor: "#b7e5f4"},
            {code : 9, name: "栃木", color: "#7ecfea", hoverColor: "#b7e5f4"},
            {code : 10, name: "群馬", color: "#7ecfea", hoverColor: "#b7e5f4"},
            {code : 11, name: "埼玉", color: "#7ecfea", hoverColor: "#b7e5f4"},
            {code : 12, name: "千葉", color: "#7ecfea", hoverColor: "#b7e5f4"},
            {code : 13, name: "東京", color: "#7ecfea", hoverColor: "#b7e5f4"},
            {code : 14, name: "神奈川", color: "#7ecfea", hoverColor: "#b7e5f4"},
            {code : 15, name: "新潟", color: "#7cdc92", hoverColor: "#aceebb"},
            {code : 16, name: "富山", color: "#7cdc92", hoverColor: "#aceebb"},
            {code : 17, name: "石川", color: "#7cdc92", hoverColor: "#aceebb"},
            {code : 18, name: "福井", color: "#7cdc92", hoverColor: "#aceebb"},
            {code : 19, name: "山梨", color: "#7cdc92", hoverColor: "#aceebb"},
            {code : 20, name: "長野", color: "#7cdc92", hoverColor: "#aceebb"},
            {code : 21, name: "岐阜", color: "#7cdc92", hoverColor: "#aceebb"},
            {code : 22, name: "静岡", color: "#7cdc92", hoverColor: "#aceebb"},
            {code : 23, name: "愛知", color: "#7cdc92", hoverColor: "#aceebb"},
            {code : 24, name: "三重", color: "#ffe966", hoverColor: "#fff19c"},
            {code : 25, name: "滋賀", color: "#ffe966", hoverColor: "#fff19c"},
            {code : 26, name: "京都", color: "#ffe966", hoverColor: "#fff19c"},
            {code : 27, name: "大阪", color: "#ffe966", hoverColor: "#fff19c"},
            {code : 28, name: "兵庫", color: "#ffe966", hoverColor: "#fff19c"},
            {code : 29, name: "奈良", color: "#ffe966", hoverColor: "#fff19c"},
            {code : 30, name: "和歌山", color: "#ffe966", hoverColor: "#fff19c"},
            {code : 31, name: "鳥取", color: "#ffcc66", hoverColor: "#ffe0a3"},
            {code : 32, name: "島根", color: "#ffcc66", hoverColor: "#ffe0a3"},
            {code : 33, name: "岡山", color: "#ffcc66", hoverColor: "#ffe0a3"},
            {code : 34, name: "広島", color: "#ffcc66", hoverColor: "#ffe0a3"},
            {code : 35, name: "山口", color: "#ffcc66", hoverColor: "#ffe0a3"},
            {code : 36, name: "徳島", color: "#fb9466", hoverColor: "#ffbb9c"},
            {code : 37, name: "香川", color: "#fb9466", hoverColor: "#ffbb9c"},
            {code : 38, name: "愛媛", color: "#fb9466", hoverColor: "#ffbb9c"},
            {code : 39, name: "高知", color: "#fb9466", hoverColor: "#ffbb9c"},
            {code : 40, name: "福岡", color: "#ff9999", hoverColor: "#ffbdbd"},
            {code : 41, name: "佐賀", color: "#ff9999", hoverColor: "#ffbdbd"},
            {code : 42, name: "長崎", color: "#ff9999", hoverColor: "#ffbdbd"},
            {code : 43, name: "熊本", color: "#ff9999", hoverColor: "#ffbdbd"},
            {code : 44, name: "大分", color: "#ff9999", hoverColor: "#ffbdbd"},
            {code : 45, name: "宮崎", color: "#ff9999", hoverColor: "#ffbdbd"},
            {code : 46, name: "鹿児島", color: "#ff9999", hoverColor: "#ffbdbd"},
            {code : 47, name: "沖縄", color: "#eb98ff", hoverColor: "#f5c9ff"},
          ],
        
          showsPrefectureName: true,
          width: 1000,
          movesIslands: true,
          borderLineColor: "#000000",
          lang: 'ja',
          onSelect: function(data){
             location.href = areaLinks[data.area.code];
          }
        });
    </script>
    <script src="{{ asset('assets/js/mypage.js') }}"></script>
</body>
</html>