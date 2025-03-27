<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class CustomCompleteEmail extends VerifyEmail
{
    private $user;
    private $buyer;
    private $purchase;

    public function __construct($user, $buyer, $purchase)
    {
        $this->user = $user;
        $this->buyer = $buyer;
        $this->purchase = $purchase;
    }

    protected function buildMailMessage($url)
    {
        return (new MailMessage)
            ->subject('取引完了連絡')
            ->greeting($this->user->name.' さん')
            ->line($this->buyer->name.' さんとの取引が完了しました。')
            ->line('以下の住所への商品の発送をお願いします。')
            ->line('')
            ->line('〒'.$this->buyer->postal_code)
            ->line($this->buyer->address)
            ->line($this->buyer->name.' 様')
            ->line('')
            ->line('商品情報')  
            ->line('商品名：'.$this->purchase->item->name)
            ->line('価格：'.$this->purchase->item->price.'円')
            ->line('')
            ->line('もし心当たりがない場合は、このメールを破棄してください。')
            ->salutation('ご確認よろしくお願いします。');

    }
}