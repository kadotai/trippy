<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TRiPPY</title>
   {{-- css --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/top.css') }}">
</head> 
<body>
    
<header>
<div class="top">
    <img class="logo" src="{{ asset('img/trippy.png') }}" alt="applogo">
    <div class="title">TRiPPY</div>
</div>
</header>


@yield('content')
<footer>
<div class="footer-icons">
<a href="{{ /top  }}"><img class=icons src="{{ asset('img/footerlogo.jpg')}}" alt="ろご"></a>
<a href="{{ rute('') }}"><img class=icons src="{{ asset('img/footerplus.png') }}" alt="新規"></a>
<a href="{{  }}"><img class=icons src="{{ asset('img/footernotic.png')}}" alt="通知"></a>
<a href="{{  }}"><img class=icons src="{{ asset('img/footermypage.png')}}" alt="マイぺージ"></a>
</div>

</footer>


</body>
</html>