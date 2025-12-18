<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>

<header class="header">
    <h1 class="logo">FashionablyLate</h1>
    <a href="{{ route('register') }}" class="login-btn">register</a>
</header>

<main class="main">
    <h2 class="title">Login</h2>

    <div class="register-box">
        <form action="{{ route('login') }}" method="post">
            @csrf

            <!--{{-- ログイン失敗エラー --}}-->
            @if ($errors->has('login'))
            <p class="error">{{ $errors->first('login') }}</p>
            @endif

            <label>メールアドレス</label>
            <input type="email" name="email" value="{{ old('email') }}">

            @error('email')
                <p class="error">{{ $message }}</p>
            @enderror

            <label>パスワード</label>
            <input type="password" name="password">

            @error('password')
                <p class="error">{{ $message }}</p>
            @enderror

            <button type="submit">ログイン</button>
        </form>
    </div>
</main>

</body>
</html>
