<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Like;
use App\Models\Purchase;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // ログインしているユーザが出品した商品は非表示
        // SQL: WHERE status != 'active'
        // User::where('status', '!=', 'active')->get();
        $items = Item::orderBy('id', 'desc')->get();

        if (auth()->check()) {
            $user = auth()->user();
            $likedItems = Like::query()
                ->with('item')
                ->where('user_id', $user->id)
                ->get();

            return view('index', compact('items', 'likedItems'));

        } else {
            return view('index', compact('items'));
        }
    }

    public function myPageIndex()
    {
        $user = auth()->user();
        $listedItems = Item::query()
            ->where('seller_id', $user->id)
            ->get();
        $purchasedItems = Purchase::query()
            ->with('item:id,name,image')
            ->where('buyer_id', $user->id)
            ->get();


        return view('mypage', compact('user', 'listedItems', 'purchasedItems'));
    }
}
