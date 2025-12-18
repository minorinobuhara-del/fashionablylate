<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>

<header class="header">
    <h1 class="logo">FashionablyLate</h1>
    <a href="{{ route('login') }}" class="login-btn">login</a>
</header>

<main class="main">
    <h2 class="title">Register</h2>

    <div class="register-box">
        <form action="{{ route('register') }}" method="post">
            @csrf

            <label>お名前</label>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="例: 山田 太郎">
            @error('name')
            <p class="error">{{ $message }}</p>
            @enderror

            <label>メールアドレス</label>
            <input type="email" name="email" value="{{ old('email') }}"placeholder="例: test@example.com">
            @error('email')
            <p class="error">{{ $message}}</p>
            @enderror

            <label>パスワード</label>
            <input type="password" name="password" placeholder="例: coachtech1106">
            @error('password')
            <p class="error">{{ $message }}</p>
            @enderror

            <button type="submit">登録</button>
        </form>
    </div>
</main>

</body>
</html>
