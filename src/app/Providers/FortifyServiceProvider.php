<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Fortify;
use App\Models\User;


class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
   {
    //ログイン画面のカスタマイズ
    Fortify::loginView(function () {
        return view('auth.login');
    });

    //会員登録画面のカスタマイズ
    Fortify::registerView(function () {
        return view('auth.register');
    });

    //ログイン処理
    Fortify::authenticateUsing(function ($request) {
            if (
                Auth::attempt(
                    $request->only('email', 'password')
                )
            ) {
                return Auth::user();
            }
            return null;
        });
   }
}