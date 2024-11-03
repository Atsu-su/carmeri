<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PurchaseController;
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

Route::get('/test/index',[HomeController::class, 'index']);

Route::middleware('header')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/guest/item/{item_id}', [ItemController::class, 'show'])->name('item.show');

    Route::middleware('auth')->group(function () {
        Route::get('/purchase/address/{item_id}', [AddressController::class, 'edit'])->name('address.edit');
        Route::post('/purchase/address/{item_id}/update', [AddressController::class, 'update'])->name('address.update');
        Route::get('/purchase/{item_id}', [PurchaseController::class, 'index'])->name('purchase');
        Route::post('/purchase/{item_id}', [PurchaseController::class, 'store'])->name('purchase.store');

        // 仮のルート
        // Route::get('/purchase/{item_id}', function ($item_id) {
        //     $item = App\Models\Item::findOrFail($item_id);
        //     return view('purchase', ['item' => $item]);
        // })->name('purchase');

        // 仮のルート
        Route::get('/home',[PurchaseController::class, 'tmpHomeView'])->name('home');
    });
});

// -------------------------------------------------------------------------

// index（商品一覧）
// Route::get('/', [HomeController::class, 'index'])->middleware('header');

// Route::get('/header/login', function () {
//   return view('index', ['headerType' => 'logIn']);
// });
// Route::get('/header/logout', function () {
//   return view('index', ['headerType' => 'logOut']);
// });

// // item（商品詳細）
// Route::get('/item', function () {
//   return view('item', ['headerType' => 'logIn']);
// });

// // register（会員登録）
// Route::get('/register', function () {
//   return view('auth.register', ['headerType' => '']);
// });

// // profile（プロフィール入力）
// Route::get('/profile', function () {
//   return view('auth.profile_input', ['headerType' => 'logIn']);
// });

// // login（ログイン画面）
// Route::get('/login', function () {
//   return view('auth.login', ['headerType' => '']);
// });

// // ログイン後の画面
// Route::get('/home', function () {
//   return view('home', ['headerType' => 'LogOut']);
// });

// // address（住所変更画面）
// Route::get('/address', function () {
//   return view('address', ['headerType' => 'logOut']);
// });

// // profile_view（プロフィール表示画面）
// Route::get('/profile_view', function () {
//   return view('profile_view', ['headerType' => 'logOut']);
// });

// // item_input（商品入力画面）
// Route::get('/item_input', function () {
//   return view('item_input', ['headerType' => 'logOut']);
// });

// // item_input（購入画面）
// Route::get('/purchase', function () {
//   return view('purchase', ['headerType' => 'logOut']);
// });