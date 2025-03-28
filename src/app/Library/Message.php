<?php

namespace App\Library;

class Message
{
    // 変数修正（chatId, receiverId, purchaseId...）
    public $chat_id;
    public $receiver_id;    // 受信者のユーザID
    public $purchase_id;    // 購入ID
    public $username;       // 送信者の名前
    public $message;        // 送信メッセージ
    public $datetime;       // 送信時間（サーバ）
    public $image;          // プロフィール画像
    public $is_text;        // テキストか画像か
}
