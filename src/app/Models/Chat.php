<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
