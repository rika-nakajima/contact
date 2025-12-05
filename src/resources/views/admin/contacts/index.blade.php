<!-- resources/views/admin/contacts/index.blade.php -->
@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="container">
    <h2>Admin</h2>

    <!-- 検索フォーム -->
    <form method="GET" action="{{ route('admin.contacts.index') }}" class="mb-3">
        <div class="row g-2">
            <!-- 名前 -->
            <div class="col-md-2">
                <input type="text" name="name" class="form-control" placeholder="名前を入力ください" value="{{ request('name') }}">
            </div>
            <!-- メールアドレス -->
            <div class="col-md-2">
                <input type="text" name="email" class="form-control" placeholder="メールアドレス" value="{{ request('email') }}">
            </div>
            <!-- 性別 -->
            <div class="col-md-2">
                <select name="gender" class="form-select">
                    <option value="">性別</option>
                    <option value="1" @if(request('gender')=='1') selected @endif>男性</option>
                    <option value="2" @if(request('gender')=='2') selected @endif>女性</option>
                    <option value="3" @if(request('gender')=='3') selected @endif>その他</option>
                </select>
            </div>
            <!-- お問い合わせ種類 -->
            <div class="col-md-3">
                <select name="category_id" class="form-select">
                    <option value="">お問い合わせの種類</option>
                    <option value="1" @if(request('category_id')=='1') selected @endif>商品のお届けについて</option>
                    <option value="2" @if(request('category_id')=='2') selected @endif>商品の交換について</option>
                    <option value="3" @if(request('category_id')=='3') selected @endif>商品トラブル</option>
                    <option value="4" @if(request('category_id')=='4') selected @endif>ショップへのお問い合わせ</option>
                    <option value="5" @if(request('category_id')=='5') selected @endif>その他</option>
                </select>
            </div>
            <!-- 日付 -->
            <div class="col-md-2">
                <input type="date" name="date" class="form-control" value="{{ request('date') }}">
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-12 text-end">
                <button type="submit" class="btn btn-primary">検索</button>
                <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary">リセット</a>
            </div>
        </div>
    </form>

     <!-- ページネーションを検索フォームの直下・右側に配置 -->
    <div class="pagination-container d-flex justify-content-end mb-3">
        {{ $contacts->links() }}
    </div>

    <!-- エクスポートボタン -->
    <div class="mb-3 text-end">
        <a href="{{ route('admin.contacts.export', request()->query()) }}" class="btn btn-success">
            エクスポート
        </a>
    </div>


    <!-- 一覧テーブル -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>お名前</th>
                <th>性別</th>
                <th>メールアドレス</th>
                <th>お問い合わせ内容</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
                <tr>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->gender }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->message }}</td>
                    <td>
                        <!-- 詳細ボタン -->
                        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#detailModal{{ $contact->id }}">
                            詳細
                        </button>

                        <!-- 削除ボタン -->
                        <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                        onclick="return confirm('本当に削除しますか？');">
                        削除
                        </button>
                        </form>



                    </td>
                </tr>

                <!-- 詳細モーダル -->
        <div class="modal fade" id="detailModal{{ $contact->id }}" tabindex="-1">
        <div class="modal-dialog modal-lg">
        <div class="modal-content detail-modal">
            <div class="modal-header">
                <h5 class="modal-title">お問い合わせ詳細</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="detail-row">
                    <span class="label">お名前</span>
                    <span class="value">{{ $contact->name }}</span>
                </div>
                <div class="detail-row">
                    <span class="label">性別</span>
                    <span class="value">{{ $contact->gender }}</span>
                </div>
                <div class="detail-row">
                    <span class="label">メールアドレス</span>
                    <span class="value">{{ $contact->email }}</span>
                </div>
                <div class="detail-row">
                    <span class="label">電話番号</span>
                    <span class="value">{{ $contact->tel }}</span>
                </div>
                <div class="detail-row">
                    <span class="label">住所</span>
                    <span class="value">{{ $contact->address }}</span>
                </div>
                <div class="detail-row">
                    <span class="label">建物名</span>
                    <span class="value">{{ $contact->building }}</span>
                </div>
                <div class="detail-row">
                    <span class="label">お問い合わせ種類</span>
                    <span class="value">{{ $contact->category_id }}</span>
                </div>
                <div class="detail-row">
                    <span class="label">お問い合わせ内容</span>
                    <span class="value">{{ $contact->message }}</span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-primary" data-bs-dismiss="modal">閉じる</button>
            </div>
        </div>
    </div>
</div>
            @endforeach
        </tbody>
    </table>

   
</div>
@endsection