
    @extends('layouts.footer')
    @section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/post.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
    @endsection

    @section('content')

    <div class="posts">
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
                <p>{{ $post->country->country_name }}</p>
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
                <p>{{ $post->content }}</p>
            </div>

            {{-- Tracking --}}
            <div class="Tracking">
                <h1>Tracking</h1>
            </div>
            
            
            {{-- されてるコメント表示 --}}
            <div class="coments">コメント一覧</div>
            @foreach ($post->comments as $comment)
            <div>
                <p>投稿日: {{ $comment->created_at->format('Y-m-d H:i') }}</p>
                <p>{{ $comment->user->name }}: {{ $comment->comment }}</p> <!-- content を comment に変更 -->
            </div>
            @endforeach

            {{-- Comment --}}

            <div class="comment-form">
            <form action="{{ route('comments.store') }}" method="POST">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <textarea name="comment" rows="5" required></textarea>
                <div class="comment-btn">
                <button type="submit">コメントを投稿する</button>
                </div>
            </form>
            </div>
    </div>
            
                {{-- Like --}}
                <div class="Like">
                    <a href="#">この投稿好きやで〜</a>
                </div>

    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>


    <script>
        const swiper = new Swiper(".swiper", {
            pagination: { el: ".swiper-pagination" },
            navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" }
        });
    </script>


    @endsection
