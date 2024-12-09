<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>create|TRiPPY</title>
    <link rel="stylesheet" href="{{ asset('assets/css/post.css') }}">

</head>
<body>

    {{-- Title --}}
    <div class="Title">
        <h1>Title</h1>
        <p>野宿</p>
    </div>

    {{-- Photo --}}
    <div class="Photo">
        <h1>Photo</h1>
        <img src="{{ asset('img/Morocco.jpg') }}" alt="旅行写真" class="travel_img">
    </div>

    {{-- Country --}}
    <div class="Country">
        <h1>Country</h1>
        <p>日本</p>
    </div>

    {{-- City --}}
    <div class="City">
        <h1>City</h1>
        <p>新潟</p>
    </div>

    {{-- Date --}}
    <div class="Date">
        <h1>Date</h1>
        <div class="Date_start_end">
            <div class="Date_start">
                <p>2003/07/22</p>
            </div>
            ~
            <div class="Date_end">
                <p>2003/07/23</p>
        </div>
    </div>
    </div>

    {{-- Tag --}}
    <div class="Tag">
    <h1>Tag</h1>
    <p class="article_tag">#海</p>
    </div>

    {{-- Caption --}}
    <div class="Caption">
        <h1>Caption</h1>
        <p>ホテルの予約はとっていたのですが、あまりにも星空が綺麗だったので野宿しました。</p>
    </div>

    {{-- Map --}}
    
    {{-- Comment --}}
    <div class="Comment">
        <h1>Comment</h1>
        <input type="text">
        <a href="#">コメント投稿</a>
    </div>

    {{-- Like --}}
        <div class="Like">
            <a href="#">この投稿好きやで〜</a>
        </div>
    </div>

</body>
</html>