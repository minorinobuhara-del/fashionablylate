<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;


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
        //$inputs = $request->all();
        $inputs = $request->validated();


        // ★ ここで変換する
    //if (isset($inputs['category'])) {
        //$inputs['category_id'] = $inputs['category'];
        //unset($inputs['category']);
    //}
        return view('contact.confirm', compact('inputs'));
    }

    // 送信処理
    public function send(ContactRequest $request)
    {
        // $inputs = $request->except('action');

        // 戻るボタン
        if ($request->action === 'back') {
            return redirect()->route('contact.form')->withInput($request->validated());
        }
         $inputs = $request->validated();

         // ★ カテゴリー変換表（文字列 → ID）
        $categoryMap = [
        '商品のお届けについて' => 1,
        '商品の交換について' => 2,
        '商品トラブル' => 3,
        'ショップへのお問い合わせ' => 4,
        'その他' => 5,
    ];
        //DBカラムに合わせて結合
        if (isset($inputs['category'])) {
            $inputs['category_id'] = $categoryMap[$inputs['category']];
            unset($inputs['category']);
        }

        //tel結合
        // tel結合
        if (isset($inputs['tel1'])) {
            $inputs['tel'] =
            $inputs['tel1'] .
            $inputs['tel2'] .
            $inputs['tel3'];

            unset($inputs['tel1'], $inputs['tel2'], $inputs['tel3']);
    }

        // ★ content → detail（DBに合わせる場合）
        if (isset($inputs['content'])) {
        $inputs['detail'] = $inputs['content'];
        unset($inputs['content']);
    }

        // DB登録処理
        Contact::create($inputs);
        //Contact::create($request->validated());

        //サンクスページ表示
        return redirect()->route('contact.thanks');
        //return view('contact.thanks');
    }

    //修正
    public function returnForm(Request $request)
    {
        return redirect()
            ->route('contact.form')
            ->withInput($request->all());
    }

    //確認画面から戻る
    //public function index()
//{
    //return view('contact.index');
//}



    //送信→DB保存→サンクス画面
    //public function store(ContactRequest $request)
    //{
        //Contact::create([
            //'last_name' => $request->last_name,
            //'first_name' => $request-> first_name,
            //'gender' => $request-> gender,
            //'email' => $request-> email,
            //'tel' => str_replace('-', '', $request->tel),
            //'address' => $request-> address,
            //'building'    => $request->building,
            //'category' => $request->category,
            //'content'     => $request->content,
        //]);
        //return view('content.thanks');

}
