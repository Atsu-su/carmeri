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
  return view('item', ['headerType' => 'onlyLogo']);
});

