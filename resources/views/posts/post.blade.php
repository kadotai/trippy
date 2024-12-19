






{{-- <!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>create|TRiPPY</title>
    <link rel="stylesheet" href="{{ asset('assets/css/post.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>

</head>

<body> --}}

    @extends('layouts.footer')
    @section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/post.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
    @endsection

    @section('content')

    <div class="posts">
        {{-- @foreach ($posts as $post) --}}
            {{-- Title --}}
            <div class="Title">
                <h1>Title</h1>
                <p>{{ $post->title }}</p>
            </div>

            {{-- Photo --}}
            <div class="Photo">
                <h1>Photo</h1>
                <div class="swiper">
                    <div class="swiper-wrapper">
                        @foreach ($post->images as $image)
                            <img src="{{ asset('storage/' . $image->img) }}" alt="画像" class="swiper-slide">
                        @endforeach
                    </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>

            {{-- Country --}}
            <div class="Country">
                <h1>Country</h1>
                <p>{{ $post->country->country_name }}</p>
            </div>

            {{-- City --}}
            <div class="City">
                <h1>City</h1>
                <p>{{ $post->city }}</p>
            </div>

            {{-- Date --}}
            <div class="Date">
                <h1>Date</h1>
                <p>{{ $post->start_date }} ~ {{ $post->end_date }}</p>
            </div>

            {{-- Tag --}}
            <div class="Tag">
                <h1>Tag</h1>
                <p class="article_tag">{{ implode(', ', $post->tags->pluck('name')->toArray()) }}</p>
            </div>

            {{-- Caption --}}
            <div class="Caption">
                <h1>Caption</h1>
                <p>{{ $post->content }}</p>
            </div>

            {{-- Tracking --}}
            <div class="Tracking">
                <h1>Tracking</h1>
                <div id="map"></div>
            </div>
            
            
            {{-- されてるコメント表示 --}}
            @foreach ($post->comments as $comment)
            <div>
                <p>{{ $comment->user->name }}: {{ $comment->comment }}</p> <!-- content を comment に変更 -->
                <p>投稿日: {{ $comment->created_at->format('Y-m-d H:i') }}</p>
            </div>
            @endforeach

        

            {{-- Like --}}
            <div class="Like">
                <a href="#">この投稿好きやで〜</a>
            </div>
        
    {{-- ちょっと練習で記載させてもろてますcana--}}
            {{-- @foreach ($posts as $post)
    <div class="post">
        <h3>{{ $post->title }}</h3>
        <button 
            class="like-button" 
            data-post-id="{{ $post->id }}" 
            data-liked="{{ $post->likes->contains('user_id', auth()->id()) ? 'true' : 'false' }}">
            {{ $post->likes->contains('user_id', auth()->id()) ? 'いいね解除' : 'いいね' }}
        </button>
        <p>いいね数: {{ $post->likes->count() }}</p>
    </div>
@endforeach --}}

            {{-- Comment --}}
            {{-- <!-- コメントフォーム -->
{{-- <form action="{{ route('comments.store', $post->id) }}" method="POST"> --}}
    {{-- @csrf
    <textarea name="comment" required placeholder="コメントを入力してください"></textarea>
    <button type="submit">コメントする</button>
</form>  --}}



            <div class="Comment">
                <h1>Comment</h1>
                <input type="text">
                <div class="Comment_a"><a href="#">コメント投稿</a></div>
            </div>
    </div>
   

    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>


    <script>
        const swiper = new Swiper(".swiper", {
            pagination: { el: ".swiper-pagination" },
            navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" }
        });
    </script>

   {{-- GoogleMapAPI --}}
   <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAsSeGO53Uzs4JgZGrKy-eokk0aAb_vGbM&callback=initMap" async defer></script>
    {{-- ルートトラッキングデータ表示させる --}}
    <script>
        // PHPから渡されたデータ
        const routeData = @json($routeData);
        function initMap() {
    try {
        // routeDataをパースして配列形式に変換
        let parsedRouteData;
        if (typeof routeData === "string") {
            parsedRouteData = JSON.parse(routeData);
        } else {
            parsedRouteData = routeData;
        }

        // データを数値型に変換
        const processedRouteData = parsedRouteData.map(point => ({
            lat: parseFloat(point.lat),
            lng: parseFloat(point.lng),
        }));

        // データが正しいかチェック
        if (!processedRouteData || processedRouteData.length === 0) {
            return;
        }

        // 地図の中心を設定
        const center = processedRouteData[0];

        // 地図を表示
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 14,
            center: center,
        });

        // Polylineを作成して地図上に表示
        const routePath = new google.maps.Polyline({
        path: processedRouteData, // 保存したルートデータ
        geodesic: true,
        strokeColor: "#FF0000", // 線の色
        strokeOpacity: 1.0, // 不透明度（完全に不透明）
        strokeWeight: 5, // 線の太さ（強調するために太く設定）
        });

        routePath.setMap(map); // 地図に描画
    } catch (error) {
        console.error("Error initializing map:", error);
    }
}

// ページ読み込み時に地図を初期化
window.onload = initMap;

    </script>


{{-- <script> いいねつけたり消したり練習でつけさしてもろてますcana--}}
    {{-- //     document.querySelectorAll('.like-button').forEach(button => {
    //         button.addEventListener('click', function() {
    //             const postId = this.dataset.postId;
    //             const liked = this.dataset.liked === 'true';
    
    //             fetch(`/posts/${postId}/like`, {
    //                 method: liked ? 'DELETE' : 'POST',
    //                 headers: {
    //                     'X-CSRF-TOKEN': '{{ csrf_token() }}',
    //                     'Content-Type': 'application/json',
    //                 }
    //             })
    //             .then(response => response.json())
    //             .then(data => {
    //                 alert(data.message);
    //                 location.reload(); // 状態更新のためリロード
    //             });
    //         });
    //     }); --}}
    {{-- </script> --}}

    @endsection
{{-- </body>


</html> --}}