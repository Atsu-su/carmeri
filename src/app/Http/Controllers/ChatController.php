<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Library\Message;
use App\Models\Chat;
use App\Models\Purchase;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ChatController extends Controller
{
    public function index($purchase_id)
    {
        // 出品者目線（購入者の情報が表示される）
        $user = auth()->user();

        // このユーザが出品者かどうかを判定
        $notSeller = false;
        $notBuyer = false;
        try {
            Purchase::query()
                ->whereHas('item', function ($query) use ($user) {
                    $query->where('seller_id', $user->id);
                })
                ->where('id', $purchase_id)
                ->firstOrFail();
        } catch (Exception $e) {
            Log::info('この人は出品者ではない');
            Log::error($e->getMessage());
            $notSeller = true;
        }

        // このユーザが購入者かどうか判定
        try {
            Purchase::query()
                ->where('buyer_id', $user->id)
                ->where('id', $purchase_id)
                ->firstOrFail();
        } catch (Exception $e) {
            Log::info('この人は購入者ではない');
            Log::error($e->getMessage());
            $notBuyer = true;
        }

        // このユーザが出品者または購入者ではない場合はアクセスを拒否
        if ($notSeller && $notBuyer) {
            abort(403);
        }

        // チャット情報を取得
        $chats = Chat::query()
            ->with('user:id,name,image')
            ->where('purchase_id', $purchase_id)
            ->orderBy('created_at', 'asc')
            ->get();

        // チャットを既読に変更する

        // 取引相手の情報を取得
        $purchase = null;
        if (!$notSeller && $notBuyer) {
            \Log::info('私は出品者です');
            // 出品者の場合は購入者の情報を取得
            $purchase = Purchase::query()
                ->with(['item:id,name,price,image', 'user:id,name,image'])
                ->where('id', $purchase_id)
                ->select('id', 'item_id', 'buyer_id')
                ->first();
        } else {
            \Log::info('私は購入者です');
            // 購入者の場合は出品者の情報を取得
            $purchase = Purchase::query()
                ->with(['item:id,seller_id,name,price,image', 'item.user:id,name,image'])
                ->where('id', $purchase_id)
                ->select('id', 'item_id')
                ->first();
        }

        // 現在取引中の出品商品
        $sellingItems = Purchase::query()
            ->with('item:id,name')
            ->whereHas('item', function ($query) use ($user) {
                $query->where('seller_id', $user->id);
            })
            ->where('status', Purchase::PROCESSING)
            ->where('id', '!=', $purchase_id)
            ->select('id', 'item_id')
            ->get();

        // 商品名が長い場合は省略する
        $sellingItems->map(function ($purchase) {
            $purchase->item->name = mb_strlen($purchase->item->name) > 7
                ? mb_substr($purchase->item->name, 0, 7) . '...'
                : $purchase->item->name;
            return $purchase;});

        // 現在取引中の購入商品
        $purchasingItems = Purchase::query()
            ->with('item:id,name')
            ->where('buyer_id', $user->id)
            ->where('status', Purchase::PROCESSING)
            ->where('id', '!=', $purchase_id)
            ->select('id', 'item_id')
            ->get();

        // 商品名が長い場合は省略する
        $purchasingItems->map(function ($purchase) {
            $purchase->item->name = mb_strlen($purchase->item->name) > 7
                ? mb_substr($purchase->item->name, 0, 7) . '...'
                : $purchase->item->name;
            return $purchase;
        });

        return view('chat',compact('chats', 'purchase', 'notBuyer', 'sellingItems', 'purchasingItems'));
    }

    public function sendMessage(Request $request)
    {
        // auth()->user() : 現在認証しているユーザーを取得
        $user = auth()->user();
        $strUsername = $user->name;

        // リクエストからデータの取り出し
        $strMessage = $request->input('message');

        // メッセージオブジェクトの作成と公開メンバー設定
        $message = new Message;
        $message->username = $strUsername;
        $message->body = $strMessage;

        // 送信者を含めてメッセージを送信
        //event( new MessageSent( $message ) ); // Laravel V7までの書き方
        MessageSent::dispatch($message);    // Laravel V8以降の書き方

        // 送信者を除いて他者にメッセージを送信
        // Note : toOthersメソッドを呼び出すには、
        //        イベントでIlluminate\Broadcasting\InteractsWithSocketsトレイトをuseする必要がある。
        // broadcast( new MessageSent($message))->toOthers();

        // return ['message' => $strMessage];
        return $request;
    }
}
