@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
<div class="auth-container">
    <h1>Login</h1>

    <form action="{{ route('login') }}" method="POST">
        @csrf

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

        <button type="submit">ログイン</button>
    </form>
</div>
@endsection