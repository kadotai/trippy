<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h1 class="overlay-text">TRiPPY</h1> 
            <img src="{{ asset('img/trippy.png')}}" alt="写真">
            <h2>Welcome Back!</h2>
            <p>Log in to your account</p>

            @if ($errors->any())
                <div class="errors">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('auth.login') }}" method="POST">
                @csrf
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Enter your email" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="btn">Log In</button>
                <p class="footer-text">
                Don't have an account? <a href="{{ route('posts.top') }}">Sign Up</a>
                </p>
            </form>
        </div>
    </div>
</body>
</html>
