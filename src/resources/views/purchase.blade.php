@extends('layouts.base')
@section('title', '商品購入')
@section('header')
  @include('components.header_switcher', ['headerType' => 'logOut'])
@endsection
@section('content')
<div id="purchase">

  {{-- 一旦コメントアウト（最終的にはモーダルにすると思われる）
  @if (session('error_message'))
  <div style= "border: 1px solid black; padding: 30px; margin-top: 30px">
    <p>{{ session('error_message.title') }}</p>
    <p>{{ session('error_message.content') }}</p>
  </div>
  @endif
   --}}

  <form action="{{ route('purchase.store', $item->id) }}" method="post">
    @csrf
    <div class="info">
      <div class="info-item">
        @if ($item->image && Storage::disk('public')->exists('item_images/'.$item->image))
          <img class="info-item-img" src="{{ asset('storage/item_images/'.$item->image) }}" width="600" height="600" alt="{{ $item->name }}の画像">
        @else
          <img class="c-no-image info-item-img" src="{{ asset('img/'.'no_image.jpg') }}" width="600" height="600" alt="商品の画像がありません">
        @endif
        <div class="info-item-value">
          <h1 class="info-item-value-name">{{ $item->name }}</h1>
          <p class="info-item-value-price">¥ {{ number_format($item->price) }}</p>
        </div>
      </div>
      <div class="info-payment">
        <h2 class="info-payment-title">支払方法</h2>
        <div class="info-payment-type">
          <select id="select" name="payment_method_id">
            <option value="" selected>未選択</option>
            <option value="1">コンビニ払い</option>
            <option value="2">カード払い</option>
          </select>
          @error('payment_method_id')
            <p class="c-error-message">{{ $message }}</p>
          @enderror
        </div>
      </div>
      <div class="info-delivery">
        <div class="info-delivery-header">
          <h2 class="info-delivery-header-title">配送先</h2>
          <a class="info-delivery-header-link" href="{{ route('address.edit', $item->id) }}">変更する</a>
        </div>
        <div class="info-delivery-main">
          <p>〒{{ $user->postal_code }}</p>
          <p>{{ $user->address }}</p>
          <p>{{ $user->building_name }}</p>
        </div>
      </div>
    </div>
    <div class="summary">
      <table>
        <tr class="summary-price">
          <th>商品代金</th>
          <td>¥ {{ number_format($item->price) }}</td>
        </tr>
        <tr class="summary-payment-type">
          <th>支払方法</th>
          <td id="payment-type">未選択</td>
        </tr>
      </table>
      @if ($item->isOnSale())
        <button class="c-btn c-btn--red" type="submit">購入する</button>
      @else
        <p class="c-btn c-btn--disabled">売り切れ</p>
        <a class="summary-link" href="{{ route('home') }}">商品一覧に戻る</a>
      @endif
    </div>
  </form>
</div>
<script>
  const select = document.getElementById('select');
  const paymentType = document.getElementById('payment-type');

  select.addEventListener('change', (e) => {
    const selectedPaymentType = e.target.selectedOptions[0].textContent;
    paymentType.textContent = selectedPaymentType;
  });
</script>
@endsection