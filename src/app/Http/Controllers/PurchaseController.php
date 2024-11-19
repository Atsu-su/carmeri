<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Purchase;
use App\Models\User;
use App\Http\Requests\PurchaseRequest;
use Illuminate\Database\QueryException;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PurchaseController extends Controller
{
    public function index($item_id)
    {
        $user = auth()->user();
        $item = Item::findOrFail($item_id);
        return view('purchase', compact('user', 'item'));
    }

    public function store(PurchaseRequest $request, $item_id)
    {
        $user = auth()->user();

        Log::info('storeメソッドスタート: user_id: '. $user->id);

        try {
            DB::beginTransaction();
            Log::info('transactionスタート: user_id: '. $user->id);

            // nameのみしか必要ないはず
            $item = Item::query()
                ->where('id', $item_id)
                ->where('on_sale', true)
                ->lockForUpdate()
                ->first();

            if (!$item) {
                return back()->with('error_message', [
                    'title' => '購入処理を完了することができませんでした',
                    'content' => '直前に他のお客様にて購入手続きが完了しました',
                ]);
            }

            $item->update(['on_sale' => false]);

            $purchase = Purchase::create([
                'item_id' => $item->id,
                'buyer_id' => $user->id,
                'payment_method_id' => $request->input('payment_method_id'),
                'status' => 'processing',
            ]);

            DB::commit();

            return $this->stripe($item, $user, $purchase);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::info('transactionロールバック: user_id: '. $user->id);
            DB::rollBack();
            return back()->with('error_message', [
                'title' => '購入処理が失敗しました',
                'content' => 'お手数ですが、しばらく時間をおいて再度お試しください',
            ]);
        }
    }

    public function stripe(Item $item, User $user, Purchase $purchase)
    {
        Stripe::setApiKey(config('stripe.stripe_secret_key'));
        $session = Session::create([
            'metadata' => [
                'user_id' => $user->id,
                'order_id' => $purchase->id
            ],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'jpy',
                    'product_data' => [
                        'name' => $item->name
                    ],
                    'unit_amount' => $item->price
                ],
                'quantity' => 1
            ]],
            'mode' => 'payment',
            'success_url' => route('payment.success', ['purchase_id' => $purchase->id]),
            'cancel_url' => route('payment.cancel', ['purchase_id' => $purchase->id]),
        ]);

        return redirect($session->url);
    }

    public function success($purchase_id)
    {
        $item = Purchase::query()
            ->where('id', $purchase_id)
            ->first();

        $successMsg = [
            'title' => '購入処理が完了しました',
            'content' => '購入処理が完了しました。購入履歴から詳細をご確認ください',
        ];

        return redirect()
            ->route('item.show', $item->item_id)
            ->with('successMsg', $successMsg);
    }

    public function cancel()
    {
        $errorMsg = [
            'title' => '購入処理をキャンセルしました',
            'content' => '引き続き、お買い物をお楽しみください',
        ];

        return view('cancel');
    }

}
