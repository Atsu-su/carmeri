@extends('layouts.base')
@section('title', '商品購入')
@section('header')
@if (isset($headerType) && $headerType === 'logIn')
{{-- ログインのボタンのヘッダー --}}
@include('components.header', ['type' => 'ログイン'])
@elseif (isset($headerType) && $headerType === 'logOut')
{{-- ログアウトのボタンのヘッダー --}}
@include('components.header', ['type' => 'ログアウト'])
@else
{{-- ロゴのみのヘッダー --}}
@include('components.header_only_logo')
@endif
@endsection
@section('content')
<div id="purchase">
  <div class="info">
    <div class="info-item">
      {{-- <img class="info-item-img" src="" width="600" height="600" alt="の画像"> --}}
      <div class="info-item-img"></div>
      <div class="info-item-value">
        <h1 class="info-item-value-name">商品名</h1>
        <p class="info-item-value-price">¥ 47,000</p>
      </div>
    </div>
    <div class="info-payment">
      <h2 class="info-payment-title">支払方法</h2>
      <select class="info-payment-type" name="payment">
        <option value="1">コンビニ払い</option>
        <option value="2">カード払い</option>
      </select>
    </div>
    <div class="info-delivery">
      <div class="info-delivery-header">
        <h2 class="info-delivery-header-title">配送先</h2>
        <a class="info-delivery-header-link" href="">変更する</a>
      </div>
      <p class="info-delivery-postal-code">〒XXX-XXXX</p>
      <p class="info-delivery-address">ここに住所が入ります</p>
    </div>
  </div>
  <div class="summary">
    <table>
      <tr>
        <th>商品代金</th>
        <td>¥ 47,000</td>
      </tr>
      <tr>
        <th>支払方法</th>
        <td>コンビニ支払い</td>
      </tr>
    </table>
    <button class="c-btn c-btn--item c-btn--red" type="submit">購入する</button>
  </div>
</div>
@endsection