<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Contact Form</title>

    <!-- sanitize.css を最初に -->
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">

    <!-- 共通スタイル -->
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')

    <!-- ページごとのスタイルを差し込む -->
    @stack('css')
</head>
<body>
    <header class="page-header">
    <h1>FashionablyLate</h1>
    <!-- resources/views/layouts/app.blade.php など共通レイアウト -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('admin.index') }}">管理画面</a>

        <div class="d-flex">
            <!-- ログアウトボタン -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-danger">Logout</button>
            </form>
        </div>
    </div>
</nav>
    </header>
    <div class="container">
        {{-- 各ページのコンテンツがここに入る --}}
        @yield('content')
    </div>
</body>
</html>