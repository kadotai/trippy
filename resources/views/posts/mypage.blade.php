@extends('layouts.footer')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/mypage.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="mypage-container">
        <section class="profile-section">
            <div class="profile">
                <img src="{{ $user->icon ? asset('storage/'.$user->icon) : asset('assets/images/default-icon.png') }}" alt="User Icon" class="profile-icon">
                <div class="small-profile">
                    <h2 class="username">{{ $user->name }}</h2>
                    <p class="visited-info">行った国数: <strong>{{ $visitedCountriesCount }}</strong></p>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST" style="margin-top: 10px;">
                @csrf
                <a href="{{ route('myinfo') }}" class="edit-btn">Edit Profile</a>
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </section>
    </div>

    <div id="map-container">
        <div id="regions_div" style="width: 100vw;"></div>
    </div>

    <div class="tab-header">
        <button class="tab-btn active" data-tab="posts">投稿一覧</button>
        <button class="tab-btn" data-tab="planning">計画中</button>
        <button class="tab-btn" data-tab="likes">いいね</button>
    </div>

    <div class="tab-content">
        {{-- 投稿一覧 --}}
        <div class="tab-pane active" id="posts">
            <div class="post-list-container">
                @foreach ($posts as $post)
                    <div class="post-card clickable" data-route="{{ route('posts.post', $post->id) }}">
                        @foreach ($post->photos as $image)
                            <img src="{{ asset('storage/' . $image->img) }}" alt="投稿画像" class="post-photo">
                        @endforeach
                        <div class="post-details">
                            <div class="title-wrapper">
                                <h2 class="title">タイトル名:{{ $post->title }}</h2>
                                <span class="status">公開中:{{ $post->post_id ? '公開' : '非公開' }}</span>
                            </div>
                            <p class="post-location">国:{{ $post->country->country_name }} / エリア: {{ $post->city }}</p>
                            <p class="post-date">年月日:{{ $post->start_date }}~{{ $post->end_date }}</p>
                            <p class="post-comment">コメント:{{ $post->content }}</p>
                            <div class="post-actions">
                                <div id="post-{{ $post->id }}">
                                    <button onclick="toggleLike({{ $post->id }})" class="like-button">
                                        <i class="{{ $post->isLikedBy(Auth::user()) ? 'fas fa-heart' : 'far fa-heart' }}"></i>
                                        <span>{{ $post->likes->count() }}</span>
                                    </button>
                                </div>
                                <button class="comment-btn">💬</button>
                                <button class="edit-btn clickable" data-route="{{ route('posts.edit',$post->id) }}">編集</button>
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
                            <p class="post-location">国:{{ $plan->country_id }} / エリア: {{ $plan->city }}</p>
                            <p class="post-date">年月日:{{ $plan->start_date }}~{{ $plan->end_date }}</p>
                            <p class="post-comment">コメント:{{ $plan->content }}</p>
                            <button class="edit-btn clickable" data-route="{{ route('posts.edit',$post->id) }}">編集</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- いいね --}}
        <div class="tab-pane" id="likes">
            <div class="post-list-container">
                @foreach ($likedPosts as $like)
                    <div class="post-card clickable" data-route="{{ route('posts.post', $like->id) }}">
                        <img src="{{ $like->images->first() ? asset('storage/'.$like->images->first()->image) : 'https://via.placeholder.com/80' }}" alt="投稿写真" class="post-photo">
                        <div class="post-details">
                            <h2 class="title">タイトル名:{{ $like->title }}</h2>
                            <div class="user-name-overlay">ユーザー名:{{ $like->user->name }}</div>
                            <p class="post-location">国:{{ $like->country_id }} / エリア:  {{ $like->city }}</p>
                            <p class="post-date">年月日:{{ $like->start_date }}~{{ $like->end_date }}</p>
                            <p class="post-comment">コメント:{{ $like->content }}</p>
                            <div class="post-actions">
                                <button onclick="toggleLike({{ $like->id }})" class="like-button">
                                    <i class="{{ $like->isLikedBy(Auth::user()) ? 'fas fa-heart' : 'far fa-heart' }}"></i>
                                    <span>{{ $like->likes->count() }}</span>
                                </button>
                                <button class="comment-btn">💬</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Google GeoChart の初期設定
        google.charts.load('current', { 'packages': ['geochart'] });
        google.charts.setOnLoadCallback(drawRegionsMap);

        // 地図描画関数
        function drawRegionsMap() {
            // サンプルデータを使用（必要に応じてサーバーからデータを取得して更新）
            var data = google.visualization.arrayToDataTable([
                ['Country', 'Popularity'],
                ['Japan', 100], // 必要に応じてデータを追加
                ['United States', 80],
                ['France', 60],
                ['Brazil', 50]
            ]);

            var options = {
                backgroundColor: '#028391',
                colorAxis: { colors: ['#99ab4e', '#99ab4e'] }, // カラースケール設定
                legend: 'none', // カラーバーを非表示
                
            };

        function toggleLike(postId) {
            fetch(`/posts/${postId}/like`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                const likeButton = document.querySelector(`#post-${postId} .like-button`);
                const heartIcon = likeButton.querySelector('i');
                const likeCount = likeButton.querySelector('span');

                if (heartIcon.classList.contains('fas')) {
                    heartIcon.classList.remove('fas');
                    heartIcon.classList.add('far');
                } else {
                    heartIcon.classList.remove('far');
                    heartIcon.classList.add('fas');
                }

                likeCount.textContent = data.likes_count;
            })
            .catch(error => console.error('Error:', error));
        }
    </script>

    <script src="{{ asset('assets/js/mypage.js') }}"></script>
@endsection
