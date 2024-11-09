<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store($item_id, CommentRequest $request)
    {
        $user = auth()->user();
        $validated = $request->validated();
        $validated['item_id'] = $item_id;
        $validated['user_id'] = $user->id;
        Comment::create($validated);
        return redirect()->back();
    }
}
