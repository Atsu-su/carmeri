<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExhibitionRequest;
use App\Models\Category;
use App\Models\CategoryItem;
use App\Models\Item;
use App\Models\Like;
use App\Models\Comment;
use App\Models\Condition;
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

    public function create()
    {
        $categories = Category::all();
        $conditions = Condition::all();
        return view('item_input', compact('categories', 'conditions'));
    }

    public function store(ExhibitionRequest $request)
    {
        //
    }
}
