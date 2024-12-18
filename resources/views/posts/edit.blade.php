<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Post | TRiPPY</title>
    <link rel="stylesheet" href="{{ asset('assets/css/edit.css') }}">
</head>
<body>
    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data" id="editForm">
        @csrf
        @method('PUT') <!-- 編集にはPUTメソッドを使用 -->

        {{-- Photo --}}
        {{-- <div class="Photo">
            <p>Photo</p>
            <input id="inputElm" type="file" name="img[]" multiple />
            <div id="preview">
                @foreach($post->photos as $photo)
                @if ($post->images->isNotEmpty()) 
                <img src="{{ asset('storage/' . $post->images->first()->img) }}" alt="旅行写真" class="travel_img">
            @else
                <img src="{{ asset('img/black_white_trippy.jpg') }}" alt="デフォルト画像" class="travel_img">
            @endif
                @endforeach
            </div> --}}
            <div class="Photo">
                <p>Photo</p>
                <input id="inputElm" type="file" name="img[]" multiple />
                <div id="preview">
                    @if ($post->photos->isNotEmpty())
                        @foreach($post->photos as $photo)
                            <img src="{{ asset('storage/' . $photo->img) }}" alt="旅行写真" class="travel_img">
                        @endforeach
                    @else
                        <img src="{{ asset('img/black_white_trippy.jpg') }}" alt="デフォルト画像" class="travel_img">
                    @endif
                </div>
            </div>
            
        </div>

        {{-- Title --}}
        <div class="Title">
            <p>Title</p>
            <input type="text" name="title" value="{{ $post->title }}">
        </div>

        {{-- Country --}}
        <div class="Country">
            <p>Country</p>
            <select name="country" id="select_country">
                @foreach ($countries as $country)
                <option value="{{ $country->id }}" {{ $post->country_id == $country->id ? 'selected' : '' }}>
                    {{ $country->country_name }}
                </option>
                @endforeach
            </select>
        </div>

        {{-- City --}}
        <div class="City">
            <p>City</p>
            <input type="text" name="city" value="{{ $post->city }}">
        </div>

        {{-- Date --}}
        <div class="Date">
            <p>Date</p>
            <div class="Date_start_end">
                <div class="Date_start">
                    <input type="date" name="start_date" value="{{ $post->start_date }}">
                </div>
                <p>~</p>
                <div class="Date_end">
                    <input type="date" name="end_date" value="{{ $post->end_date }}">
                </div>
            </div>
        </div>

        {{-- Tag --}}
        <div class="Tag">
            <p>Tag</p>
            <section class="edit_selected_tag">
                @foreach ($tags as $tag)
                    <button type="button" class="tag-button {{ in_array($tag->id, $post->tags->pluck('id')->toArray()) ? 'selected' : '' }}" 
                        name="tags[]" 
                        data-tag="{{ $tag->id }}">
                        {{ $tag->tag_name }}
                    </button>
                @endforeach
            </section>
        </div>

        {{-- Caption --}}
        <div class="Caption">
            <p>Caption</p>
            <input type="text" name="caption" value="{{ $post->content }}">
        </div>

        {{-- Map --}}
        <div class="Tracking">
            <p>Tracking</p>
            <div id="map" style="height: 400px;"></div> <!-- 地図の表示領域 -->
            {{-- 隠しフィールド --}}
            <input type="hidden" name="route_data" id="routeDataInput" value="{{ $post->route_data }}">
            <input type="hidden" name="duration" id="durationInput" value="{{ $post->duration }}">
        </div>

        {{-- Public --}}
        <div class="Public">
            <div class="public_private">
                <input type="radio" id="private" name="open" value="private" {{ $post->post_type == 'private' ? 'checked' : '' }}>
                <label for="private">非公開</label>
            </div>
            <div class="public_public">
                <input type="radio" id="public" name="open" value="public" {{ $post->post_type == 'public' ? 'checked' : '' }}>
                <label for="public">公開</label>
            </div>
        </div>

        <div class="link">
            {{-- Delete --}}
            {{-- <div class="Delete">
                <a href="{{ route('posts.destroy', $post->id) }}" onclick="return confirm('削除してもよろしいですか？')">削除</a>
            </div> --}}

            {{-- Update --}}
            <div class="Update">
                <button type="submit" id="updateRoute">更新</button>
            </div>
        </div>
    </form>

</body>
</html>
