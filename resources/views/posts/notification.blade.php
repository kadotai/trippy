@extends('layouts.original')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/notification.css') }}">
@endsection

@section('content')

<section>
<div class="notifititle">🔔NOTIFICATIONS</div>
{{-- <a href="{{ route('posts.post') }}" class='noti-btn'> --}}
    <div class="coment noti-card">
    <h2> Shizukaがコメントしました</h2>
    <h3>　あなたの投稿：About to died</h3>
    <h3>　 South Africa / Johannesburg</h3>
    <h3>　 2019-06-04 ~ 2019-06-25</h3>
    </div>
</a>
{{-- <a href="{{ route('posts.post') }}" class='noti-btn'> --}}
    <div class="coment noti-card">
        <h2> Gakutoがいいねしました</h2>
        <h3>　あなたの投稿：Load trip</h3>
        <h3>　 New Zealand / Aucland</h3>
        <h3>　 2020-11-09 ~ 2020-11-20</h3>
    </div>
</a>
{{-- <a href="{{ route('posts.post') }}" class='noti-btn'> --}}
    <div class="coment noti-card">
        <h2> Naoがいいねしました</h2>
        <h3>　あなたの投稿：Sinulog festival</h3>
        <h3>　 Philippines / Cebu</h3>
        <h3>　 2025-01-19 ~ 2025-01-21</h3>
    </div>
</a>
{{-- <a href="{{ route('posts.post') }}" class='noti-btn'> --}}
    <div class="coment noti-card">
    <h2> Ayakaがコメントしました</h2>
    <h3>　あなたの投稿：Merry Christmas</h3>
    <h3>　 Australia / Sydney</h3>
    <h3>　 2024-09-29 ~ 2024-09-30</h3>
    </div>
</a>
{{-- <a href="{{ route('posts.post') }}" class='noti-btn'> --}}
    <div class="coment noti-card">
    <h2> Taichiがコメントしました</h2>
    <h3>　あなたの投稿：I love Bohol</h3>
    <h3>　 Philippines / Bohol</h3>
    <h3>　 2024-10-15 ~ 2024-10-17</h3>
    </div>
</a>
{{-- <a href="{{ route('posts.post') }}" class='noti-btn'> --}}
    <div class="coment noti-card" id="last">
        <h2> Canaがいいねしました</h2>
        <h3>　あなたの投稿：The ocean is my home</h3>
        <h3>　 Japan / Okinawa</h3>
        <h3>　 2020-02-14 ~ 2020-02-18</h3>
    </div>
</a>

<section>   

@endsection