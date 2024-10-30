<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function categoryItems()
    {
        return $this->hasMany(CategoryItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Review::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function purchase()
    {
        return $this->hasOne(Purchase::class, 'buyer_id');
    }
}
