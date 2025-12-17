<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function show()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate(
        [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ],
        [
            // お名前
            'name.required' => 'お名前を入力してください',

            // メールアドレス
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスはメール形式で入力してください',

            // パスワード
            'password.required' => 'パスワードを入力してください',
        ]
    );
        // 登録処理
    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

        return redirect('/login');
    }

}
