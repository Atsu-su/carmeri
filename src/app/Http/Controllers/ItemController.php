<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExhibitionRequest;
use App\Models\Category;
use App\Models\CategoryItem;
use App\Models\Item;
use App\Models\Like;
use App\Models\Comment;
use App\Models\Condition;
use App\Messages\Session as MessageSession;
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

        if (auth()->check()) {
            // いいねしているかどうかを判定（true or false）
            $user = auth()->user();
            $like = Like::query()
                ->where('item_id', $item_id)
                ->where('user_id', $user->id)
                ->exists();
        } else {
            $like = false;
        }

        // リダイレクトされた場合に存在する可能性のあるメッセージを処理
        $message = MessageSession::exists('message');

        return view('item', compact('item', 'like', 'message'));
    }

    public function create()
    {
        $categories = Category::all();
        $conditions = Condition::all();
        return view('item_input', compact('categories', 'conditions'));
    }

    public function store(ExhibitionRequest $request)
    {
        $user = auth()->user();

        $extension = $request->file('image')->extension();
        $fileName = 'item_image_'. time() . '.' . $extension;
        $request->file('image')->storeAs('public/item_images', $fileName);

        $validated = $request->validated();
        $itemData = array_merge($validated, [
            'seller_id' => $user->id,
            'image' => $fileName,
        ]);
        $item = Item::create($itemData);

        foreach($itemData['category_id'] as $category_id) {
            CategoryItem::create([
                'item_id' => $item->id,
                'category_id' => $category_id,
            ]);
        }

        return redirect()->route('index');
    }
}
