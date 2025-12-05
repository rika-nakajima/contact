@push('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endpush

@extends('layouts.app')

@section('content')
<h1>Contact</h1>

<form action="{{ route('contact.confirm') }}" method="POST">
    @csrf

    <!-- お名前（姓・名を分ける） -->
    <div class="name-group">
        <label class="required">お名前※</label><br>
        <input type="text" name="last_name" value="{{ old('last_name') }}" maxlength="8" required class="input-gray" placeholder="姓">
        <input type="text" name="first_name" value="{{ old('first_name') }}" maxlength="8" required class="input-gray" placeholder="名">
        @error('last_name')
            <p style="color:red">{{ $message }}</p>
        @enderror
        @error('first_name')
            <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <!-- 性別（枠なし） -->
    <div class="gender-group">
        <label class="required">性別※</label><br>
        <input type="radio" name="gender" value="1" {{ old('gender') == 1 ? 'checked' : '' }}> 男性
        <input type="radio" name="gender" value="2" {{ old('gender') == 2 ? 'checked' : '' }}> 女性
        <input type="radio" name="gender" value="3" {{ old('gender') == 3 ? 'checked' : '' }}> その他
        @error('gender')
            <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <!-- メールアドレス -->
    <div class="mail-group">
        <label class="required">メールアドレス※</label><br>
        <input type="email" name="email" value="{{ old('email') }}" required class="input-gray">
        @error('email')
            <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <!-- 電話番号（3分割） -->
    <div class="tel-group">
    <label class="required">電話番号※</label><br>

    <input type="text" name="tel1" value="{{ old('tel1') }}"
        maxlength="3" inputmode="numeric" pattern="\d{2,3}"
        required class="input-gray"> -

    <input type="text" name="tel2" value="{{ old('tel2') }}"
        maxlength="4" inputmode="numeric" pattern="\d{3,4}"
        required class="input-gray"> -

    <input type="text" name="tel3" value="{{ old('tel3') }}"
        maxlength="4" inputmode="numeric" pattern="\d{4}"
        required class="input-gray">

    @error('tel1') <p style="color:red">{{ $message }}</p> @enderror
    @error('tel2') <p style="color:red">{{ $message }}</p> @enderror
    @error('tel3') <p style="color:red">{{ $message }}</p> @enderror
    </div>

    <!-- 住所 -->
    <div class="address">
        <label class="required">住所※</label><br>
        <input type="text" name="address" value="{{ old('address') }}" required class="input-gray">
        @error('address')
            <p style="color:red">{{ $message }}</p>
        @enderror
    </div>
    <div class="building">
    <label>建物名（任意）</label><br>
    <input type="text" name="building" value="{{ old('building') }}" class="input-gray">
    </div>

    <!-- お問い合わせの種類 -->
    <div class="category_id">
        <label class="required">お問い合わせの種類※</label><br>
        <select name="category_id" required class="input-gray">
            <option value="">選択してください</option>
            <option value="1" {{ old('category_id') == 1 ? 'selected' : '' }}>商品のお届けについて</option>
            <option value="2" {{ old('category_id') == 2 ? 'selected' : '' }}>商品の交換について</option>
            <option value="3" {{ old('category_id') == 3 ? 'selected' : '' }}>商品トラブル</option>
            <option value="4" {{ old('category_id') == 4 ? 'selected' : '' }}>ショップへのお問い合わせ</option>
            <option value="5" {{ old('category_id') == 5 ? 'selected' : '' }}>その他</option>
        </select>
        @error('category_id')
            <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <!-- お問い合わせ内容 -->
    <div class="message">
        <label class="required">お問い合わせ内容※</label><br>
        <textarea name="message" maxlength="120" required class="input-gray">{{ old('message') }}</textarea>
        @error('message')
            <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit">確認画面へ</button>
</form>
@endsection