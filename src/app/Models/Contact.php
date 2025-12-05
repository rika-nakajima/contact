<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    // 保存可能なカラムを指定
    protected $fillable = [
        'name',        // お名前（最大8文字）
        'gender',      // 性別（1:男性, 2:女性, 3:その他）
        'email',       // メールアドレス
        'tel',         // 電話番号（最大5桁）
        'address',     // 住所
        'category_id', // お問い合わせの種類
        'message',     // お問い合わせ内容（最大120文字）
    ];
}