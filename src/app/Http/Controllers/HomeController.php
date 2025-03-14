<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Like;
use App\Models\Purchase;
use App\Messages\Session as MessageSession;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            $user = auth()->user();

            $items = Item::query()
                ->where('seller_id', '!=', $user->id)
                ->orderBy('id', 'desc')
                ->get();

            $likedItems = Like::query()
                ->with('item')
                ->where('user_id', $user->id)
                ->whereHas('item', function ($query) use ($user) {
                    $query->where('seller_id', '!=', $user->id);
                })
                ->orderBy('item_id', 'desc')
                ->get();

            return view('index', compact('items', 'likedItems'));
        } else {
            $items = Item::orderBy('id', 'desc')->get();
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
        $message = MessageSession::exists('message');

        // 1. 出品者の場合
        // ・purchasesテーブルにあるレコードのうち、自分が出品した商品の情報と
        //   purchase_idを取得する

        // purchase_id/チャットの内容も全て取れた。しかも最新のチャット順に並んでいる
        $sellingItems = Purchase::query()
            ->with(['item:id,name,price,image', 'chats' => function($query) use ($user) {
                $query->where('sender_id', '!=', $user->id)
                    ->where('is_read', false);
            }])
            ->whereHas('item', function ($query) use ($user) {
                $query->where('seller_id', $user->id);
            })
            ->whereHas('chats')
            ->select('purchases.id', 'purchases.item_id')
            ->join(DB::raw('(SELECT purchase_id, MAX(created_at) as latest_chat FROM chats GROUP BY purchase_id) as latest_chats'), 
                   'purchases.id', '=', 'latest_chats.purchase_id')
            ->orderBy('latest_chats.latest_chat', 'desc')
            ->get();

        // これがいらない
        $sellingItemsMessagesCount = $sellingItems->map(function ($item) use ($user) {
            // $item->idはpurchase_id
            // 購入者のメッセージ数（未読）を取得する
            return Chat::query()
                ->where('purchase_id', $item->id)
                ->where('sender_id', '!=', $user->id)
                ->where('is_read', false)
                ->count();
        });

        // 2. 購入者の場合
        // ・purchasesテーブルのレコードのうち、自分が購入した商品の情報と
        //   purchase_idを取得する

        $purchasingItems = Purchase::query()
            ->with('item:id,name,price,image')
            ->where('buyer_id', $user->id)
            ->select('id','item_id')
            ->get();

        $purchasingItemsMessagesCount = $purchasedItems->map(function ($item) use ($user) {
            // $item->idはpurchase_id
            // 出品者のメッセージ数を取得する
            return Chat::query()
                ->where('purchase_id', $item->id)
                ->where('sender_id', '!=', $user->id)
                ->where('is_read', false)
                ->count();
        });

        return view('mypage',
            compact(
                'user',
                'listedItems',
                'purchasedItems',
                'sellingItems',
                'sellingItemsMessagesCount',
                'purchasingItems',
                'purchasingItemsMessagesCount',
                'message'
            )
        );
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        if (auth()->check()) {
            $user = auth()->user();

            $items = Item::query()
                ->where('name', 'like', "%$keyword%")
                ->where('seller_id', '!=', $user->id)
                ->orderBy('id', 'desc')
                ->get();

            $likedItems = Like::query()
                ->with('item')
                ->where('user_id', $user->id)
                ->whereHas('item', function ($query) use ($keyword, $user) {
                    $query->where('name', 'like', "%$keyword%")
                          ->where('seller_id', '!=', $user->id);
                })
                ->orderBy('item_id', 'desc')
                ->get();

            return view('index', compact('items', 'likedItems', 'keyword'));
        } else {
            $items = Item::query()
            ->where('name', 'like', "%$keyword%")
            ->orderBy('id', 'desc')
            ->get();

            return view('index', compact('items', 'keyword'));
        }
    }
}
