@extends('layouts.base')
@section('title', '商品詳細')
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
<div id="item">
  <div class="item-img">
    {{-- <img src="" width="600" height="600" alt="の画像"> --}}
    <div class="img"></div>
  </div>
  <div class="item-detail">
    <h1 class="item-detail-title">商品名がここに入る</h1>
    <p class="item-detail-brand">ブランド名</p>
    <p class="item-detail-price">¥<span>47,000</span> (税込)</p>
    <div class="item-detail-icons">
      <div class="item-detail-icons-icon item-detail-icons-like">
        <span>123</span>
      </div>
      <div class="item-detail-icons-icon item-detail-icons-comment">
        <span>123</span>
      </div>
    </div>
    <a href="" class="item-detail-btn c-btn c-btn--red c-btn--item">購入手続きへ</a>
    <h2 class="item-detail-title-about">商品説明</h2>
    <p class="item-detail-about">
      カラー：グレー<br>
      <br>
      新品<br>
      商品の状態は良好です。傷もありません。<br>
      <br>
      購入後、即発送いたします。
    </p>
    <h2 class="item-detail-title-general">商品の情報</h2>
    <table class="item-detail-general">
      <tr>
        <th>カテゴリ</th>
        <td>
          <span class="c-label-category c-label-category--gray">洋服</span>
          <span class="c-label-category c-label-category--gray">メンズ</span>
          <span class="c-label-category c-label-category--gray">メンズ</span>
          <span class="c-label-category c-label-category--gray">メンズ</span>
          <span class="c-label-category c-label-category--gray">メンズ</span>
          <span class="c-label-category c-label-category--gray">メンズ</span>
          <span class="c-label-category c-label-category--gray">メンズ</span>
          <span class="c-label-category c-label-category--gray">メンズ</span>
          <span class="c-label-category c-label-category--gray">メンズ</span>
          <span class="c-label-category c-label-category--gray">メンズ</span>
          <span class="c-label-category c-label-category--gray">メンズ</span>
        </td>
      </tr>
      <tr>
        <th>商品の状態</th>
        <td>良好</td>
      </tr>
    </table>
    <div class="item-detail-comment">
      <h2 class="item-detail-comment-title">コメント(1)</h2>
      <div class="item-detail-comment-commenter">
        <div class="item-detail-comment-commenter-img">
          <img src="" alt="">
        </div>
        <p class="item-detail-comment-commenter-user">admin</p>
      </div>
      <p class="item-detail-comment-body">ここにコメントの内容が入ります。あいうえおあいうえおあいうえおあいうえおあいうえおあいうえお </p>
      <h3 class="item-detail-comment-title-form">商品へのコメント</h3>
      <div class="item-detail-comment-form">
        <form action="" method="post">
          <textarea name="comment" id="comment" cols="30" rows="10"></textarea>
          <button class="c-btn c-btn--item" type="submit">コメントを送信する</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection