@extends('layouts.original')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/top.css') }}">
@endsection

@section('content')
{{-- @foreach($posts as $post) --}}
{{-- データベースからデータ引っ張って来れるように --}}
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
{{-- @endforeach --}}

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
