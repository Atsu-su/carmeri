<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function edit($item_id)
    {
        $user = auth()->user();
        return view('address', compact('user', 'item_id'));
    }

    public function update(AddressRequest $request, $item_id)
    {
        $validated = $request->validated();
        $user = auth()->user();

        // 時間があればtry-catchを入れる
        $user->update($validated);

        return redirect()->route('purchase', $item_id);
    }
}
