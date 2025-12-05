<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;


class ContactController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::query();

        // 名前検索（部分一致・完全一致両方対応）
        if ($request->filled('name')) {
            $name = $request->input('name');
            $query->where('name', 'like', "%{$name}%");
        }

        // メールアドレス検索
        if ($request->filled('email')) {
            $email = $request->input('email');
            $query->where('email', 'like', "%{$email}%");
        }

        // 性別検索
        if ($request->filled('gender')) {
            $query->where('gender', $request->input('gender'));
        }

        // お問い合わせ種類検索
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        // 日付検索（created_atを対象）
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->input('date'));
        }

        // ページネーション（7件ごと）
        $contacts = $query->paginate(7)->appends($request->query());

        return view('admin.contacts.index', compact('contacts'));
    }

    public function export(Request $request)
{
    $query = Contact::query();

    // 検索条件を再利用
    if ($request->filled('name')) {
        $query->where('name', 'like', "%{$request->name}%");
    }
    if ($request->filled('email')) {
        $query->where('email', 'like', "%{$request->email}%");
    }
    if ($request->filled('gender')) {
        $query->where('gender', $request->gender);
    }
    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }
    if ($request->filled('date')) {
        $query->whereDate('created_at', $request->date);
    }

    $contacts = $query->get();

    $csvHeader = ['ID','名前','性別','メールアドレス','電話番号','住所','建物名','種類','内容','登録日'];
    $csvData = $contacts->map(function($c) {
        return [
            $c->id,
            $c->name,
            $c->gender,
            $c->email,
            $c->tel,
            $c->address,
            $c->building,
            $c->category_id,
            $c->message,
            $c->created_at->format('Y-m-d'),
        ];
    });

    $filename = 'contacts_export.csv';
    $handle = fopen('php://temp', 'r+');
    fputcsv($handle, $csvHeader);
    foreach ($csvData as $row) {
        fputcsv($handle, $row);
    }
    rewind($handle);
    $csv = stream_get_contents($handle);
    fclose($handle);

    return Response::make($csv, 200, [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => "attachment; filename={$filename}",
    ]);
}

}