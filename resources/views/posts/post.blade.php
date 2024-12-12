<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>create|TRiPPY</title>
    <link rel="stylesheet" href="{{ asset('assets/css/post.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>

</head>

<body>
    <div class="posts">
        @foreach ($posts as $post)
            {{-- Title --}}
            <div class="Title">
                <h1>Title</h1>
                <p>{{ $post->title }}</p>
            </div>

            {{-- Photo --}}
            <div class="Photo">
                <h1>Photo</h1>
                <div class="swiper">
                    <div class="swiper-wrapper">
                        @foreach ($post->photos as $photo)
                            <img src="{{ asset('storage/' . $photo->path) }}" alt="画像" class="swiper-slide">
                        @endforeach
                    </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>

            {{-- Country --}}
            <div class="Country">
                <h1>Country</h1>
                <p>{{ $post->country }}</p>
            </div>

            {{-- City --}}
            <div class="City">
                <h1>City</h1>
                <p>{{ $post->city }}</p>
            </div>

            {{-- Date --}}
            <div class="Date">
                <h1>Date</h1>
                <p>{{ $post->start_date }} ~ {{ $post->end_date }}</p>
            </div>

            {{-- Tag --}}
            <div class="Tag">
                <h1>Tag</h1>
                <p class="article_tag">{{ implode(', ', $post->tags->pluck('name')->toArray()) }}</p>
            </div>

            {{-- Caption --}}
            <div class="Caption">
                <h1>Caption</h1>
                <p>{{ $post->caption }}</p>
            </div>
        @endforeach
    </div>

    <script>
        const swiper = new Swiper(".swiper", {
            pagination: { el: ".swiper-pagination" },
            navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" }
        });
    </script>
    
</body>


</html>