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
    <!-- ロゴ -->
    <div class="logo-container">
        <img src="" alt="ロゴ" class="logo">
    </div>
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
            <input type="file" id="user-icon" accept="image/*" onchange="previewIcon(event)">
            <div class="icon-preview-container">
                <img id="icon-preview" class="icon-preview" src="#" alt="プレビュー">
            </div>
        </div>

        <!-- 性別 -->
        <div class="input-group">
            <label>性別</label>
            <div class="radio-labels">
                <div>
                    <input type="radio" id="male" name="sex" value="male" required>
                    <label for="male">男</label>
                    <input type="radio" id="female" name="sex" value="female">
                    <label for="female">女</label>
                    <input type="radio" id="other" name="sex" value="other">
                    <label for="other">それ以外</label>
                </div>
            </div>
        </div>

        <!-- 誕生日 -->
        <div class="input-group">
            <label for="birthday-year">誕生日 (西暦)</label>
            <input type="number" id="birthday-year" placeholder="西暦を入力してください" min="1900" max="2024" required>
        </div>

        <!-- 国籍 -->
        <div class="input-group">
            <label for="nationality">国籍</label>
            <input type="text" id="nationality" placeholder="国籍を入力してください" value="日本" required>
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

<script>
function previewIcon(event) {
    const preview = document.getElementById('icon-preview');
    preview.src = URL.createObjectURL(event.target.files[0]);
    preview.style.display = 'block';
}
</script>

</body>
</html>
