<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
    //return view('welcome');
//});
Route::get('/contact', [ContactController::class, 'index'])
    ->name('contact.index');
Route::get('/contact/form', [ContactController::class, 'form'])->name('contact.form');
Route::post('/contact/return', [ContactController::class, 'returnForm'])->name('contact.return');
Route::post('/contact/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');
Route::get('/contact/thanks', function () {
    return view('contact.thanks');
})->name('contact.thanks');

//初期状態のお問い合わせフォームに戻るためのルートを追加
Route::get('/', [ContactController::class, 'form']);

//会員登録画面
Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

//ログイン画面
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

//管理画面
Route::get('/admin', [AdminController::class, 'index'])
    ->middleware('auth')
    ->name('admin');

//ログアウトへのルート追加
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

//エクスポート機能
Route::get('/admin/export', [AdminController::class, 'export'])
    ->middleware('auth')
    ->name('admin.export');

//モーダル表示時に削除依頼する
Route::delete('/admin/{id}', [AdminController::class, 'destroy'])
    ->middleware('auth')
    ->name('admin.destroy');

