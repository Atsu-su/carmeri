<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Profiler\Profile;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        return view('profile_input', compact('user'));
    }

    public function store(ProfileRequest $request){
        /*
        * 流れ
        * 1. リクエストから画像を取得
        * 2. 画像がある場合、画像を保存（アップデート）
        * 3. 画像がない場合（nullの場合）、imageの項目を除きアップデート
        * 4. 2の場合アップデート成功後、前の画像を削除
        */

        $user = auth()->user();
        $currentImage = $user->image;
        $validated = $request->validated();

        if ($request->file('image')) {
            // 新しく画像が登録される場合
            $extension = $request->file('image')->extension();
            $fileName = 'profile_image_'. time() . '.' . $extension;
            $request->file('image')->storeAs('public/profile_images', $fileName);

            $validated['image'] = $fileName;
        } else {
            // 画像が登録されない場合
            $validated['image'] = null;
        }

        $user->update($validated);

        if ($user->wasChanged('image') && $currentImage) {
            // 画像が変更された場合、古い画像を削除
            Storage::delete('public/profile_images/' . $currentImage);
        }

        return redirect()->route('mypage');
    }
}
