<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Library\Message;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        $listedItems = \App\Models\Item::query()
        ->where('seller_id', $user->id)
        ->get();
        $purchasedItems = \App\Models\Purchase::query()
        ->with('item:id,name,image')
        ->where('buyer_id', $user->id)
        ->first();
        $message = \App\Messages\Session::exists('message');

        return view('chat', compact('user', 'listedItems', 'purchasedItems', 'message'));
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
