<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>result|trippy</title>
</head>
<body>

    {{-- 検索欄 --}}
    <section class="result_search">
        <div class="search">
              <input type="search" id="post-search" class="search_box">
              <button class="search_button">検索</button>
        </div>
    </section>
    
    {{-- タグ --}}
    <section class="result_selected_tag">
        @foreach ($tags as $tag)
          <p class="tag">{{ $tag -> tag_name }}</p>
        @endforeach
    </section>

    {{-- 検索結果 --}}
    <section>

    </section>

</body>
</html>