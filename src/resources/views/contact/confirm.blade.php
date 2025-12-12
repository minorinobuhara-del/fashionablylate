@extends('layouts.app')
@section('title', '確認画面')

@section('content')
<h1>確認画面</h1>

<form action="{{ route('contact.send') }}" method="post">
    @csrf

    @foreach ($inputs as $key => $value)
        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
    @endforeach

    <table class="confirm-table">
        <tr><th>お名前</th><td>{{ $inputs['lastname'] }} {{ $inputs['firstname'] }}</td></tr>
        <tr><th>性別</th><td>{{ $inputs['gender'] }}</td></tr>
        <tr><th>メール</th><td>{{ $inputs['email'] }}</td></tr>
        <tr><th>電話番号</th><td>{{ $inputs['tel1'] }}-{{ $inputs['tel2'] }}-{{ $inputs['tel3'] }}</td></tr>
        <tr><th>住所</th><td>{{ $inputs['address'] }}</td></tr>
        <tr><th>建物名</th><td>{{ $inputs['building'] }}</td></tr>
        <tr><th>種類</th><td>{{ $inputs['category'] }}</td></tr>
        <tr><th>内容</th><td>{!! nl2br(e($inputs['message'])) !!}</td></tr>
    </table>

    <button name="action" value="send" class="btn">送信する</button>
    <button name="action" value="back" class="btn-back">戻る</button>
</form>

@endsection
