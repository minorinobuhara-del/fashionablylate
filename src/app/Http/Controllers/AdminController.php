<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::query();

        // 名前検索（姓・名・フルネーム / 部分一致）
        if ($request->filled('name')) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->name . '%')
                ->orWhere('last_name', 'like', '%' . $request->name . '%')
                ->orWhereRaw("CONCAT(last_name, first_name) LIKE ?", ['%' . $request->name . '%']);
            });
        }

        //メールアドレス検索
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        // 性別
        if ($request->gender && $request->gender !== 'all') {
            $query->where('gender', $request->gender);
        }

        // お問い合わせ種類
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // 日付
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->paginate(7)->withQueryString();

        return view('admin.index', compact('contacts'));
    }

    //エクスポート機能
    public function export()
    {
        $contacts = Contact::with('category')->get();

        $response = new StreamedResponse(function () use ($contacts) {
        $handle = fopen('php://output', 'w');

        //csvヘッダー
        fputcsv($handle, [
                'お名前',
                '性別',
                'メールアドレス',
                'お問い合わせの種類',
                '内容',
                '作成日'
            ]);

            // ===== データ移行 =====
            foreach ($contacts as $contact) {
                fputcsv($handle, [
                    $contact->name,
                    $contact->gender,
                    $contact->email,
                    $contact->category->content ?? '',
                    $contact->detail,
                    $contact->created_at,
                ]);
            }
                fclose($handle);
    });

        $response->headers->set('Content-Type', 'text/csv; charset=UTF-8');
        $response->headers->set(
            'Content-Disposition',
            'attachment; filename="contacts.csv"'
        );

        return $response;
    }

    // 省略（index, export など）

    public function destroy($id)
    {
        Contact::findOrFail($id)->delete();

        return redirect()
            ->route('admin')
            ->with('message', '削除しました');
    }
}