@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@section('title', 'Thanks')

@section('content')

<div class="thanks-wrapper">

    <p class="thanks-message">
        お問い合わせありがとうございました
    </p>

    <a href="{{ url('/') }}" class="thanks-btn">
        HOME
    </a>

</div>

@endsection
