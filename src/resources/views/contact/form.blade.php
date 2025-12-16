@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/form.css') }}">
@section('title', 'お問い合わせ')

@section('content')

<h1>Contact</h1>

<form action="{{ route('contact.confirm') }}" method="post">
    @csrf

    <div class="form-group">
        <label>お名前 *</label>
        <div class="name-flex">
            <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="例: 山田">
            <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="例: 太郎">
        </div>
        @error('last_name') <p class="error">{{ $message }}</p> @enderror
        @error('first_name') <p class="error">{{ $message }}</p> @enderror
    </div>

    <div class="form-group">
        <label>性別 *</label>
        <label><input type="radio" name="gender" value="男性" {{ old('gender')=='男性'?'checked':'' }}> 男性</label>
        <label><input type="radio" name="gender" value="女性" {{ old('gender')=='女性'?'checked':'' }}> 女性</label>
        <label><input type="radio" name="gender" value="その他" {{ old('gender')=='その他'?'checked':'' }}> その他</label>
        @error('gender') <p class="error">{{ $message }}</p> @enderror
    </div>

    <div class="form-group">
        <label>メールアドレス *</label>
        <input type="email" name="email" value="{{ old('email') }}" placeholder="test@example.com">
        @error('email') <p class="error">{{ $message }}</p> @enderror
    </div>

    <div class="form-group">
        <label>電話番号 *</label>
        <div class="tel-flex">
            <input type="text" name="tel1" value="{{ old('tel1') }}" placeholder="080">
            <input type="text" name="tel2" value="{{ old('tel2') }}" placeholder="1234">
            <input type="text" name="tel3" value="{{ old('tel3') }}" placeholder="5678">
        </div>
        @error('tel1') <p class="error">{{ $message }}</p> @enderror
    </div>

    <div class="form-group">
        <label>住所 *</label>
        <input type="text" name="address" value="{{ old('address') }}" placeholder="東京都渋谷区…">
        @error('address') <p class="error">{{ $message }}</p> @enderror
    </div>

    <div class="form-group">
        <label>建物名</label>
        <input type="text" name="building" value="{{ old('building') }}" placeholder="マンション101">
    </div>

    <div class="form-group">
        <label>お問い合わせ種類 *</label>
        <select name="category">
            <option value="">選択してください</option>
            <option value="商品のお届けについて" {{ old('category')=='商品のお届けについて'?'selected':'' }}>商品のお届けについて</option>
            <option value="商品の交換について" {{ old('category')=='商品の交換について'?'selected':'' }}>商品の交換について</option>
            <option value="商品トラブル" {{ old('category')=='商品トラブル'?'selected':'' }}>商品トラブル</option>
            <option value="ショップへのお問い合わせ" {{ old('category')=='ショップへのお問い合わせ'?'selected':'' }}>ショップへのお問い合わせ</option>
            <option value="その他" {{ old('category')=='その他'?'selected':'' }}>その他</option>
        </select>
        @error('category') <p class="error">{{ $message }}</p> @enderror
    </div>

    <div class="form-group">
        <label>お問い合わせ内容 *</label>
        <textarea name="message" placeholder="ご記入ください">{{ old('message') }}</textarea>
        @error('message') <p class="error">{{ $message }}</p> @enderror
    </div>

    <button type="submit" class="btn">確認画面へ</button>
</form>

@endsection
