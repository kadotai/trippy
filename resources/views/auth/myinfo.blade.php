{{-- <!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="{{ asset('assets/css/myinfo.css') }}">
</head> --}}
{{-- <body> --}}
    @extends('layouts.footer')

    @section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/myinfo.css') }}">
    @endsection

    @section('content')
    <h1>Edit Profile</h1>

    <!-- 成功メッセージの表示 -->
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <!-- エラーメッセージの表示 -->
    @if($errors->any())
        <ul style="color: red;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('myinfo.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            @if($user->icon)
            <div>
            <img src="{{ asset('storage/' . $user->icon) }}" alt="プロフィールアイコン" style="max-width: 150px;">
            </div>
            @endif
            <label>Icon</label>
            <input type="file" name="icon">

        </div>
        <div>
            <label>Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
        </div>
        <div>
            <label>Mail Address</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
        </div>
        <div>
            <label>Password (Only Changing)</label>
            <input type="password" name="password">
        </div>
        <div>
            <label>Check Password</label>
            <input type="password" name="password_confirmation">
        </div>
        
        <button type="submit">Update</button>
    </form>

    @endsection
{{-- </body>
</html> --}}
