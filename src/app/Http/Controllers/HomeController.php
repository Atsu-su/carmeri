<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Like;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $items = Item::orderBy('id', 'desc')->get();

        if (auth()->check()) {
            $user = auth()->user();
            $likedItems = Like::with('item')
                ->where('user_id', $user->id)
                ->get();

            return view('index', compact('items', 'likedItems'));

        } else {
            return view('index', compact('items'));
        }
    }
}
