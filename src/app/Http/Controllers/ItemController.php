<?php

namespace App\Http\Controllers;

use App\Models\CategoryItem;
use App\Models\Item;
use App\Models\Like;
use App\Models\Comment;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function show($item_id)
    {
        $item = Item::query()
            ->with(['categoryItems.category', 'condition', 'comments.user'])
            ->withCount('likes')
            ->withCount('comments')
            ->find($item_id);
        return view('item', compact('item'));
    }
}
