@push('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endpush

@extends('layouts.app')

@section('content')
<h1>Confirm</h1>

<table class="confirm-table">
    <tr>
        <th>お名前</th>
        <td>{{ $last_name }} {{ $first_name }}</td>
    </tr>

    <tr>
        <th>性別</th>
        <td>
            @if($gender == 1) 男性
            @elseif($gender == 2) 女性
            @else その他
            @endif
        </td>
    </tr>

    <tr>
        <th>メールアドレス</th>
        <td>{{ $email }}</td>
    </tr>

    <tr>
        <th>電話番号</th>
        <td>{{ $tel }}</td> {{-- ← 結合済みの電話番号 --}}
    </tr>

    <tr>
        <th>住所</th>
        <td>{{ $address }}</td>
    </tr>

    @if(!empty($building))
    <tr>
        <th>建物名</th>
        <td>{{ $building }}</td>
    </tr>
    @endif

    <tr>
        <th>お問い合わせの種類</th>
        <td>
            @switch($category_id)
                @case(1) 商品のお届けについて @break
                @case(2) 商品の交換について @break
                @case(3) 商品トラブル @break
                @case(4) ショップへのお問い合わせ @break
                @case(5) その他 @break
            @endswitch
        </td>
    </tr>

    <tr>
        <th>お問い合わせ内容</th>
        <td>{{ $message }}</td>
    </tr>
</table>

{{-- 送信ボタン --}}
<form action="{{ route('contact.store') }}" method="POST" style="margin-top:20px;">
    @csrf
    <input type="hidden" name="last_name" value="{{ $last_name }}">
    <input type="hidden" name="first_name" value="{{ $first_name }}">
    <input type="hidden" name="gender" value="{{ $gender }}">
    <input type="hidden" name="email" value="{{ $email }}">
    <input type="hidden" name="tel" value="{{ $tel }}"> {{-- ← 結合済み電話番号 --}}
    <input type="hidden" name="address" value="{{ $address }}">
    <input type="hidden" name="building" value="{{ $building }}">
    <input type="hidden" name="category_id" value="{{ $category_id }}">
    <input type="hidden" name="message" value="{{ $message }}">
    <button type="submit">送信する</button>
</form>

{{-- 修正ボタン --}}
<form action="{{ route('contact.index') }}" method="GET" style="margin-top:10px;">
    <button type="submit">修正する</button>
</form>
@endsection