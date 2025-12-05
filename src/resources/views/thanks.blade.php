@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<div class="thanks-container">
    <div class="thanks-message">
        お問い合わせありがとうございました。
    </div>
    <a href="{{ route('contact.index') }}" class="home-btn">HOME</a>
</div>
@endsection