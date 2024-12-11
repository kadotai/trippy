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
    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf <!-- CSRF保護のため -->
        
        {{-- Photo --}}
        <div class="Photo">
            <p>Photo</p>
            <input type="file" name="photo">
        </div>

        {{-- Title --}}
        <div class="Title">
            <p>Title</p>
            <input type="text" name="title" required>
        </div>

        {{-- Country --}}
        <div class="Country">
            <p>Country</p>
            <input type="text" name="country" required>
        </div>

        {{-- City --}}
        <div class="City">
            <p>City</p>
            <input type="text" name="city" required>
        </div>

        {{-- Date --}}
        <div class="Date">
            <p>Date</p>
            <div class="Date_start_end">
                <div class="Date_start">
                    <input type="date" name="date_start" required>
                </div>
                <p>~</p>
                <div class="Date_end">
                    <input type="date" name="date_end" required>
                </div>
            </div>
        </div>

        {{-- Tag --}}
        <div class="Tag">
            <p>Tag</p>
            <input type="text" name="tag" required>
        </div>

        {{-- Caption --}}
        <div class="Caption">
            <p>Caption</p>
            <input type="text" name="caption" required>
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
                <a href="{{ route('posts.store') }}" id="saveRoute"></a>
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

                    // 現在位置をオブジェクト形式で保存
                    const currentPosition = { lat: latitude, lng: longitude };
                    route.push(currentPosition); // 正しい形式で保存

                    // 地図の中心を現在位置に移動
                    map.setCenter(currentPosition);

                    // マーカーの位置を更新
                    marker.setPosition(currentPosition);

                    // 地図上にルートを描画
                    new google.maps.Polyline({
                        path: route, // 修正後の `route` を使用
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
        document.getElementById('stopTracking').addEventListener('click', async () => {
            if (watchId) {
                navigator.geolocation.clearWatch(watchId);
                alert("ルートトラッキングを終了しました！");
            }

            // 距離を計算 (Haversine Formula)
            function calculateDistance(route) {
                const R = 6371; // 地球の半径 (km)
                let totalDistance = 0;

                for (let i = 1; i < route.length; i++) {
                    const lat1 = route[i - 1].lat;
                    const lon1 = route[i - 1].lng;
                    const lat2 = route[i].lat;
                    const lon2 = route[i].lng;

                    const dLat = ((lat2 - lat1) * Math.PI) / 180;
                    const dLon = ((lon2 - lon1) * Math.PI) / 180;

                    const a =
                        Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                        Math.cos((lat1 * Math.PI) / 180) * Math.cos((lat2 * Math.PI) / 180) *
                        Math.sin(dLon / 2) * Math.sin(dLon / 2);
                    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
                    totalDistance += R * c;
                }

                return totalDistance;
            }

            const distance = calculateDistance(route);
            const duration = (Date.now() - startTime) / 1000; // 所要時間を秒で計算

            const data = {
                route_data: route, // 修正後の形式で保存
                distance: distance,
                duration: duration
            };

            try {
                const response = await fetch('/post', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(data)
                });

                if (response.ok) {
                    alert("データが保存されました！");
                } else {
                    alert("データの保存に失敗しました。");
                }
            } catch (error) {
                console.error("保存エラー:", error);
                alert("通信エラーが発生しました。");
            }

            document.getElementById('startTracking').disabled = false;
            document.getElementById('stopTracking').disabled = true;
        });
    </script>
    
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAsSeGO53Uzs4JgZGrKy-eokk0aAb_vGbM&callback=initMap" async defer></script>
</body>
</html>
