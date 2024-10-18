@extends('layouts.base')
@section('title', '')
@section('header')
  @if (isset($headerType) && $headerType === 'logIn')
    {{-- ログインのボタンのヘッダー --}}
    @include('components.header_log_in')
  @elseif (isset($headerType) && $headerType === 'logOut')
    {{-- ログアウトのボタンのヘッダー --}}
    @include('components.header_log_out')
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
      <h1 class="item-detail-title-name">商品名がここに入る</h1>
      <p class="item-detail-brand">ブランド名</p>
      <p class="item-detail-price">¥47,000 (税込)</p>
      <div class="item-detail-icons">
        <div class="item-detail-icons-icon item-detail-icons-like">
          <span>123</span> 
        </div>
        <div class="item-detail-icons-icon item-detail-icons-comment">
          <span>123</span> 
        </div>
      </div>
      <a href="" class="item-detail-btn c-btn c-btn--item">購入手続きへ</a>
      <h2 class="item-detail-title-about">商品説明</h2>
      <p>カラー：グレー</p>
      <div class="item-detail-condition">
        <p>新品</p>
        <p>商品の状態は良好です。傷もありません。</p>
      </div>
      <p>購入後、即発送いたします</p>
      <h2>商品の情報</h2>
      <table>
        <tr>
          <th>カテゴリ</th>
          <td>
            <span>洋服</span>
            <span>メンズ</span>
          </td>
        </tr>
        <tr>
          <th>状態</th>
          <td>良好</td>
        </tr>
      </table>
      <div class="comment">
        <h2>コメント(1)</h2>
        <div class="comment-commenter">
          <div class="comment-commenter-img">
            <img src="" alt="">
          </div>
          <p>admin</p>
        </div>
        <p class="comment-body">ここにコメントの内容が入ります。</p>
      </div>
      <div class="comment-form">
        <form action="" method="post">
          <textarea name="comment" id="comment" cols="30" rows="10"></textarea>
          <button type="submit">コメントを送信する</button>
        </form>
      </div>
    </div>
  </div>
@endsection