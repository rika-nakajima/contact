<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Models\Contact;

class ContactController extends Controller
{
    // 入力フォーム表示
    public function index()
    {
        return view('index');
    }

    // 確認画面表示
    public function confirm(ContactFormRequest $request)
    {
        $validated = $request->validated();

        // 電話番号を結合
        $tel = $validated['tel1'] . $validated['tel2'] . $validated['tel3'];

        return view('confirm', [
            'last_name'   => $validated['last_name'],
            'first_name'  => $validated['first_name'],
            'gender'      => $validated['gender'],
            'email'       => $validated['email'],
            'tel'         => $tel,  // ← 結合後の電話番号を渡す
            'address'     => $validated['address'],
            'building'    => $validated['building'] ?? null, // ← 任意項目
            'category_id' => $validated['category_id'],
            'message'     => $validated['message'],
        ]);
    }

    // データ保存 & 完了画面表示
    public function store(ContactFormRequest $request)
    {
        $validated = $request->validated();

        // 電話番号を結合
        $tel = $validated['tel1'] . $validated['tel2'] . $validated['tel3'];

        // 保存処理（DB登録）
        Contact::create([
            'name'        => $validated['last_name'] . $validated['first_name'],
            'gender'      => $validated['gender'],
            'email'       => $validated['email'],
            'tel'         => $tel,
            'address'     => $validated['address'],
            'building'    => $validated['building'] ?? null,
            'category_id' => $validated['category_id'],
            'message'     => $validated['message'],
        ]);

        return view('thanks');
    }
}