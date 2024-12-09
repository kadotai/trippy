<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>create|TRiPPY</title>
    <link rel="stylesheet" href="{{ asset('assets/css/create.css') }}">

</head>
<body>
    {{-- Photo --}}
    <div class="Photo">
        <p>Photo</p>
        <input type="file">
    </div>

    {{-- Title --}}
    <div class="Title">
        <p>Title</p>
        <input type="text">
    </div>

    {{-- Country --}}
    <div class="Country">
        <p>Country</p>
        <input type="text">
    </div>

    {{-- City --}}
    <div class="City">
        <p>City</p>
        <input type="text">
    </div>

    {{-- Date --}}
    <div class="Date">
        <p>Date</p>
        <div class="Date_start_end">
            <div class="Date_start">
                <input type="date">
            </div>
            <p>~</p>
            <div class="Date_end">
                <input type="date">
        </div>
    </div>
    </div>

    {{-- Tag --}}
    <div class="Tag">
        <p>Tag</p>
        <input type="text">
    </div>

    {{-- Caption --}}
    <div class="Caption">
        <p>Caption</p>
        <input type="text">
    </div>

    {{-- memo --}}
    <div class="Memo">
        <p>Memo</p>
        <input type="text" value="" placeholder="このメモは非公開です" >
    </div>

    {{-- Map --}}
    
    {{-- Public --}}
    <div class="Public">
        <div class="public_private">
            <input type="radio" id="contactChoice2" name="open" value="private">
            <label for="contactChoice2">非公開</label>
        </div>
        <div class="public_public">
            <input type="radio" id="contactChoice1" name="open" value="public">
            <label for="contactChoice1">公開</label>
        </div>
    </div>

    <div class="link">
    {{-- Delete --}}
        <div class="Delete">
            <a href="#">削除</a>
        </div>

    {{-- Store --}}
        <div class="Store">
            <a href="#">保存</a>
        </div>
    </div>

</body>
</html>