@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
<h1>Register</h1>
<div class="auth-container">

<form action="{{ route('register') }}" method="POST">
    @csrf

    <!-- お名前 -->
    <div>
        <label for="name">お名前 <span style="color:red">※必須</span></label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required>
        @error('name')
            <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <!-- メールアドレス -->
    <div>
        <label for="email">メールアドレス <span style="color:red">※必須</span></label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        @error('email')
            <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <!-- パスワード -->
    <div>
        <label for="password">パスワード <span style="color:red">※必須</span></label>
        <input type="password" id="password" name="password" required>
        @error('password')
            <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <!-- パスワード確認 -->
    <div>
        <label for="password_confirmation">パスワード（確認）</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>
    </div>

    <button type="submit">登録</button>
</form>
</div>
@endsection