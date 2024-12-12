<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Welcome</title>
<link rel="stylesheet" href="{{ asset('assets/css/welcome.css') }}">
</head>
<body>
    <div class="welcome-container">
        <div class="welcome-box">
            <img src="{{ asset('img/trippy.png')}}" alt="写真1">
            <h1>Welcome to Our Platform</h1>
            <p>Join us and start connecting with others!</p>
            <div class="button-group">
                <a href="{{ route('login') }}" class="btn login-btn">Log In</a>
                <a href="{{ route('auth.register') }}" class="btn register-btn">Register</a>
            </div>
        </div>
    </div>
</body>
</html>
