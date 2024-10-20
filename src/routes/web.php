<?php

use Illuminate\Support\Facades\Route;

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

// index（商品一覧）
Route::get('/', function () {
    return view('index', ['headerType' => 'onlyLogo']);
});
Route::get('/header/login', function () {
  return view('index', ['headerType' => 'logIn']);
});
Route::get('/header/logout', function () {
  return view('index', ['headerType' => 'logOut']);
});

// item（商品詳細）
Route::get('/item', function () {
  return view('item', ['headerType' => 'logIn']);
});

// register（会員登録）
Route::get('/register', function () {
  return view('auth.register', ['headerType' => '']);
});

// profile（プロフィール入力）
Route::get('/profile', function () {
  return view('auth.profile', ['headerType' => 'logIn']);
});

// login（ログイン画面）
Route::get('/login', function () {
  return view('auth.login', ['headerType' => '']);
});

// address（住所変更画面）
Route::get('/address', function () {
  return view('address', ['headerType' => 'logOut']);
});

// profile_view（プロフィール表示画面）
Route::get('/profile_view', function () {
  return view('profile_view', ['headerType' => 'logOut']);
});
