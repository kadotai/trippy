{{-- フッター:cana --}}
   @extends('layouts.footer')

   @section('css')
    <title>create|TRiPPY</title>
    <link rel="stylesheet" href="{{ asset('assets/css/create.css') }}">
   @endsection

   @section('content')
   
    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" id="tripForm">
        @csrf <!-- CSRF保護のため -->
        
        {{-- Photo --}}
        <div class="Photo">
            <p>Photo</p>
            <input id="inputElm" type="file" name="images[]" multiple />
            <div id="preview"></div>
        </div>

        {{-- Title --}}
        <div class="Title">
            <p>Title</p>
            <input type="text" name="title">
        </div>

        {{-- Country --}}
        <div class="Country">
            <p>Country</p>
            <select name="country" id="select_country">
                @foreach ($countries as $country)
                <option value="{{ $country->country_name}}">{{ $country->country_name }}</option>
                @endforeach
            </select>
        </div>

        {{-- City --}}
        <div class="City">
            <p>City</p>
            <input type="text" name="city">
        </div>

        {{-- Date --}}
        <div class="Date">
            <p>Date</p>
            <div class="Date_start_end">
                <div class="Date_start">
                    <input type="date" name="start_date">
                </div>
                <p>~</p>
                <div class="Date_end">
                    <input type="date" name="end_date">
                </div>
            </div>
        </div>

        {{-- Tag --}}
        <div class="Tag">
            <p>Tag</p>
            <section class="create_selected_tag">
                @foreach ($tags as $tag)
                    <button type="button" class="tag-button" name="tags[]" data-tag="{{ $tag->id }}">{{ $tag ->tag_name }}</button>
                @endforeach
            </section>
        </div>

        {{-- Caption --}}
        <div class="Caption">
            <p>Caption</p>
            <input type="text" name="caption">
        </div>

        {{-- Map --}}
        <div class="Tracking">
            <p>Tracking</p>
            <div id="map" style="height: 400px;"></div> <!-- 地図の表示領域 -->

            {{-- スタートボタンとストップボタン --}}
            <div class="MapControl">
                <button type="button" id="startTracking">スタート</button>
                <button type="button" id="stopTracking" disabled>ストップ</button>
            </div>

            {{-- 隠しフィールド --}}
            <input type="hidden" name="route_data" id="routeDataInput">
            <input type="hidden" name="duration" id="durationInput">
        </div>

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
                <button type="submit" id="saveRoute">保存</button>
            </div>
        </div>
    </form>

    <script>
        let marker;
        let watchId;
        let route = [];
        let startTime = null; // 開始時刻を保持するグローバル変数
        let map;

        // 地図の初期化
        function initMap() {
            const initialPosition = { lat: 35.6895, lng: 139.6917 }; // 東京

            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 13,
                center: initialPosition,
            });

            marker = new google.maps.Marker({
                position: initialPosition,
                map: map,
            });
        }

        // スタートボタンが押されたとき
        document.getElementById('startTracking').addEventListener('click', () => {
            if (!navigator.geolocation) {
                alert("位置情報が利用できません");
                return;
            }

            alert("ルートトラッキングを開始します！");
            startTime = Date.now(); // トラッキング開始時刻を記録

            watchId = navigator.geolocation.watchPosition(
                position => {
                    const { latitude, longitude } = position.coords;

                    const currentPosition = { lat: latitude, lng: longitude };
                    route.push(currentPosition);

                    map.setCenter(currentPosition);
                    marker.setPosition(currentPosition);

                    new google.maps.Polyline({
                        path: route,
                        geodesic: true,
                        strokeColor: '#FF0000',
                        strokeOpacity: 1.0,
                        strokeWeight: 2,
                        map: map
                    });
                },
                error => {
                    console.error("位置情報エラー:", error);
                },
                { enableHighAccuracy: true }
            );

            document.getElementById('startTracking').disabled = true;
            document.getElementById('stopTracking').disabled = false;
        });

        // ストップボタンが押されたとき
        document.getElementById('stopTracking').addEventListener('click', () => {
            if (watchId) {
                navigator.geolocation.clearWatch(watchId);
                alert("ルートトラッキングを終了しました！");
            }

            const duration = (Date.now() - startTime) / 1000; // 所要時間を秒で計算
            document.getElementById('routeDataInput').value = JSON.stringify(route);
            document.getElementById('durationInput').value = duration;

            document.getElementById('startTracking').disabled = false;
            document.getElementById('stopTracking').disabled = true;
        });

        document.getElementById('inputElm').addEventListener('change', function(event) {
    const preview = document.getElementById('preview');
    Array.from(event.target.files).forEach(file => {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result; // プレビュー画像のソース
            img.style.maxWidth = '150px'; // プレビュー画像の最大幅
            img.style.marginRight = '10px';
            img.style.marginBottom = '10px';
            preview.appendChild(img); // プレビューに画像を追加
        }
        reader.readAsDataURL(file); // ファイルデータを読み込む
    });
});

        // const inputElm = document.getElementById('inputElm');
        // inputElm.addEventListener('change', (e) => {
        //     const file = e.target.files[0];
        //     const fileReader = new FileReader();

        //     fileReader.readAsDataURL(file);
        //     fileReader.addEventListener('load', (e) => {
        //         const imgElm = document.createElement('img');
        //         imgElm.src = e.target.result;

        //         const targetElm = document.getElementById('preview');
        //         targetElm.appendChild(imgElm);
        //     });
        // });

          // タグの選択機能
    document.addEventListener('DOMContentLoaded', () => {
        const selectedTags = new Set(); // 選択されたタグIDを保持するSet
        const tagButtons = document.querySelectorAll('.tag-button'); // タグボタンを取得
        const form = document.getElementById('tripForm'); // フォーム全体

        // タグボタンのクリックイベントを設定
        tagButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault(); // デフォルトの動作を無効化

                const tagId = button.getAttribute('data-tag'); // タグのIDを取得

                
                // 選択状態の切り替え
                if (selectedTags.has(tagId)) {
                    selectedTags.delete(tagId);
                    button.classList.remove('selected'); // 選択中のスタイルを削除
                } else {
                    selectedTags.add(tagId);
                    button.classList.add('selected'); // 選択中のスタイルを追加
                }

                // フォームに選択されたタグを反映
                updateHiddenInputs();
            });
        });

        // 非表示の<input>要素を更新する関数
        function updateHiddenInputs() {
            // 既存のタグ入力を削除
            document.querySelectorAll('input[name="tags[]"]').forEach(input => input.remove());

            // 選択されたタグIDをhidden inputとして追加
            selectedTags.forEach(tagId => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'tags[]';
                input.value = tagId;
                form.appendChild(input);
            });
        }
    });
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAsSeGO53Uzs4JgZGrKy-eokk0aAb_vGbM&callback=initMap" async defer></script>



    @endsection