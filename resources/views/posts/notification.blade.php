@extends('layouts.original')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/notification.css') }}">
@endsection



@section('content')



<section>
<div class="notifititle">🔔NOTIFICATIONS</div>
<a href="{{ route('posts.post') }}" class='noti-btn'>
    <div class="coment noti-card">
    <h2>がコメントしました</h2>
    <h2>あなたの投稿：内容…</h2>
    </div>
</a>
<a href="{{ route('posts.post') }}" class='noti-btn'>
    <div class="coment noti-card">
        <h2>〇〇〇〇さんがええやんしました</h2>
        <h2>あなたの投稿：内容…</h2>
    </div>
</a>




<section>   

@endsection