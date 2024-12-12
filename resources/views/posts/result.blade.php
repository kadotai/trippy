@extends('layouts.original')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/top.css') }}">
@endsection

@section('content')







{{-- @foreach($posts as $post)
{{-- データベースからデータ引っ張って来れるように --}}
<section class="top_all_article_list">
    <div class="article_card"><a href="{{ route('posts.post') }}" class="article_card_link">
        <div class="article_card_left">
            <h1 class="username">ユーザーneme</h1>
            <img src="" alt="旅行写真" class="travel_img">
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


@foreach($posts as $post)
<section class="top_all_article_list">
    <div class="article_card">
        <a href="{{ route('posts.post', $post->id) }}" class="article_card_link">
            <div class="article_card_left">
                <h1 class="username">{{ $post->user->name }}</h1>
                @if ($post->images->isNotEmpty())
                    {{-- 画像がある場合は表示 --}}
                    <img src="{{ asset($post->images->first()->image_path) }}" alt="旅行写真" class="travel_img">
                @else
                    {{-- 画像がない場合のデフォルト --}}
                    <img src="{{ asset('img/default_image.jpg') }}" alt="デフォルト画像" class="travel_img">
                @endif
            </div>
            <div class="article_card_right">
                <ul class="where">
                    <li class="country">{{ $post->country }}</li>
                    <li class="city">&nbsp;{{ $post->city }}</li>
                </ul>
                <p class="date">{{ $post->start_date }}~{{ $post->end_date }}</p>
                <p class="trip_title">{{ $post->title }}</p>
                <p class="article_tag">{{ $post->tag }}</p>
                <div class="like_and_comment">
                    <div class="like">
                        <img src="{{ asset('img/like_icon.png') }}" alt="like" class="like_icon">
                        <p class="like_number">{{ $post->likes }}</p>
                    </div>
                    <div class="comment">
                        <img src="{{ asset('img/comment_icon.png') }}" alt="comment" class="comment_icon">
                        <p class="comment_number">{{ $post->comments }}</p>
                    </div>
                </div>
            </div>
        </a>
    </div>
</section>
@endforeach
@endsection
