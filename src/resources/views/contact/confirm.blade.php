<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm</title>
    @extends('layouts.app')
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
    @section('title', '確認画面')
    @section('content')
</head>
<body>
    <div class="confirm-header">
    <h1 class="site-title">FashionablyLate</h1>
    <p class="page-title">Confirm</p>
    </div>

<div class="confirm-table-wrapper">
<table class="confirm-table">
    <tr><th>お名前</th><td>{{ $inputs['last_name'] }} {{ $inputs['first_name'] }}</td></tr>
    <tr><th>性別</th><td>{{ $inputs['gender'] }}</td></tr>
    <tr><th>メール</th><td>{{ $inputs['email'] }}</td></tr>
    <tr><th>電話番号</th>
        <td>{{ $inputs['tel1'] }}-{{ $inputs['tel2'] }}-{{ $inputs['tel3'] }}</td>
    </tr>
    <tr><th>住所</th><td>{{ $inputs['address'] }}</td></tr>
    <tr><th>建物名</th><td>{{ $inputs['building'] ?? '' }}</td></tr>
    <tr><th>種類</th><td>{{ $inputs['category'] }}</td></tr>
    <tr><th>内容</th><td>{!! nl2br(e($inputs['content'])) !!}</td></tr>
</table>
</div>

<div class="confirm__btn-wrapper">
{{-- 送信ボタン --}}
<form action="{{ route('contact.send') }}" method="post">
    @csrf
    @foreach ($inputs as $name => $value)
        <input type="hidden" name="{{ $name }}" value="{{ $value }}">
    @endforeach
    <button type="submit" class="confirm-btn">送信する</button>
</form>

{{-- 修正ボタン --}}
<form action="{{ route('contact.return') }}" method="post">
    @csrf
    @foreach ($inputs as $key => $value)
        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
    @endforeach
    <button type="submit" class="confirm-back">修正</button>
</form>
</div>
</body>
@endsection
