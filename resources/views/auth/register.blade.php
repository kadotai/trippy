<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>新規登録</title>
<link rel="stylesheet" href="{{ asset('assets/css/register.css') }}">
</head>
<body>
<div class="register-container">
    <div class="register-box">
    <h1>新規登録</h1>
    <form>
        <!-- ユーザー名 -->
        <div class="input-group">
            <label for="username">ユーザー名</label>
            <input type="text" id="username" placeholder="ユーザー名を入力してください" required>
        </div>

        <!-- ユーザーアイコン -->
        <div class="input-group">
            <label for="user-icon">ユーザーアイコン</label>
            <input type="file" id="user-icon" accept="image/*">
        </div>

        <!-- 性別 -->
        <div class="input-group">
            <label for="sex">性別</label>
            <select id="sex" required>
            <option value="">選択してください</option>
            <option value="male">男</option>
            <option value="female">女</option>
            <option value="other">それ以外</option>
            </select>
        </div>

        <!-- 誕生日 -->
        <div class="input-group">
            <label for="birthday">誕生日</label>
            <input type="date" id="birthday" required>
        </div>

        <!-- 国籍 -->
        <div class="input-group">
            <label for="nationality">国籍</label>
            <select id="nationality" required>
            <option value="">選択してください</option>
            <option value="japan">日本</option>
            <option value="usa">アメリカ</option>
            <option value="uk">イギリス</option>
            <option value="china">中国</option>
            <option value="korea">韓国</option>
            <option value="other">その他</option>
        </select>
        </div>

        <!-- パスワード入力 -->
        <div class="input-group">
            <label for="password">パスワード</label>
            <input type="password" id="password" placeholder="パスワードを入力してください" required>
        </div>

        <!-- 再度パスワード入力 -->
        <div class="input-group">
            <label for="confirm-password">パスワード確認</label>
            <input type="password" id="confirm-password" placeholder="再度パスワードを入力してください" required>
        </div>

        <!-- 登録ボタン -->
        <button type="submit" class="btn">登録</button>
    </form>
    </div>
</div>
</body>
</html>
