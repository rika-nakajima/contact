<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------

*/

// トップページ
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| お問い合わせフォームのルート設定
|--------------------------------------------------------------------------
*/

// 入力フォーム
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');

// 確認画面
Route::post('/contact/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');

// 保存 & 完了画面
Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');

// サンクスページ（直接アクセス用）
Route::get('/thanks', function () {
    return view('thanks');
})->name('thanks');

/*
|--------------------------------------------------------------------------
| ユーザ認証関連
|--------------------------------------------------------------------------
*/

// ユーザ登録
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// ログイン
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// ログアウト
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| 管理画面
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware(['auth'])->group(function () {
    // 管理画面トップ
    Route::get('/', function () {
        return view('admin.index');
    })->name('admin.index');

    // お問い合わせ一覧
    Route::get('/contacts', [AdminContactController::class, 'index'])
        ->name('admin.contacts.index');

    // 検索
    Route::get('/contacts/search', [AdminContactController::class, 'search'])
        ->name('admin.contacts.search');

    // 検索リセット
    Route::get('/contacts/reset', [AdminContactController::class, 'reset'])
        ->name('admin.contacts.reset');

    // お問い合わせ削除
    Route::delete('/contacts/{id}', [AdminContactController::class, 'destroy'])
        ->name('admin.contacts.destroy');

    // エクスポート
    Route::get('/contacts/export', [AdminContactController::class, 'export'])
        ->name('admin.contacts.export');
});

