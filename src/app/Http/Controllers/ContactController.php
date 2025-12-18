<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    // フォーム表示
    public function form()
    {
        return view('contact.form');
    }

    // 確認画面
    public function confirm(ContactRequest $request)
    {
        $inputs = $request->all();
        return view('contact.confirm', compact('inputs'));
    }

    // 送信処理
    public function send(ContactRequest $request)
    {
        $inputs = $request->except('action');

        // 戻るボタン
        if ($request->action === 'back') {
            return redirect()->route('contact.form')->withInput($inputs);
        }
        // 登録処理
    Contact::create($inputs);

        return view('contact.thanks');
    }

    //修正
    public function returnForm(Request $request)
    {
        return redirect()
            ->route('contact.form')
            ->withInput($request->all());
    }

    //確認画面から戻る
    public function index()
{
    return view('contact.index');
}



    //送信→DB保存→サンクス画面
    public function store(ContactRequest $request)
    {
        Contact::create([
            'last_name' => $request->last_name,
            'first_name' => $request-> first_name,
            'gender' => $request-> gender,
            'email' => $request-> email,
            'tel' => str_replace('-', '', $request->tel),
            'address' => $request-> address,
            'building'    => $request->building,
            'category' => $request->category,
            'content'     => $request->content,
        ]);
        return view('content.thanks');

    }
}
