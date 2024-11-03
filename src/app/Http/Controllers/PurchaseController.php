<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PurchaseController extends Controller
{
    const LOCK_TIMEOUT = 5;

    // 削除すること
    public function tmpHomeView()
    {
        return view('home');
    }

    public function index($item_id)
    {
        $user = auth()->user();
        $item = Item::findOrFail($item_id);
        return view('purchase', compact('user', 'item'));
    }

    public function store(Request $request, $item_id)
    {
        $user = auth()->user();

        Log::info('storeメソッドスタート');

        try {
            $response = DB::transaction(function() use ($request, $item_id, $user) {
                Log::info('transactionスタート');

                // nameのみしか必要ないはず
                $item = Item::query()
                    ->where('id', $item_id)
                    ->where('on_sale', true)
                    ->sharedLock()
                    ->first();

                // $itemのon_saleがfalseかどうか確認する
                if (!$item) {
                    Log::info('item_id: ' . $item_id . ' is not on sale');
                    return back()->with('error_message', [
                        'title' => '購入処理が失敗しました',
                        'content' => '直前に他のお客様にて購入手続きが完了しました',
                    ]);
                }

                $item->update(['on_sale' => false]);

                Purchase::create([
                    'item_id' => $item_id,
                    'buyer_id' => $user->id,
                    'payment_method_id' => $request->input('payment'),
                ]);

                return redirect()
                    ->route('home')
                    ->with('message', '購入処理が完了しました')
                    ->with('item', $item->toArray());

            }, self::LOCK_TIMEOUT);

            return $response;

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::info('transactionロールバック');
            DB::rollBack();
            return back()->with('error_message', [
                'title' => '購入処理が失敗しました',
                'content' => 'お手数ですが、しばらく時間をおいて再度お試しください',
            ]);
        }
    }
}
