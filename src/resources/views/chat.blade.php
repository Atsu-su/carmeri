@extends('layouts.base')
@section('title', 'チャット')
@section('modal')
  @include('components.modal')
@endsection
@section('header')
  @include('components.header')
@endsection
@section('content')
  <div id="chat">
    <aside class="sidebar">
      <h3 class="sidebar-title">その他の取引</h3>
      <h4 class="sidebar-title-listed">出品</h4>
      <ul class="sidebar-items">
        <li class="sidebar-items-name"><a href="">商品名１</a></li>
        <li class="sidebar-items-name"><a href="">商品名２</a></li>
        <li class="sidebar-items-name"><a href="">商品名３</a></li>
      </ul>
      <h4 class="sidebar-title-processing">購入</h4>
      <ul class="sidebar-items">
        <li class="sidebar-items-name"><a href="">商品名A</a></li>
        <li class="sidebar-items-name"><a href="">商品名B</a></li>
        <li class="sidebar-items-name"><a href="">商品名C</a></li>
      </ul>
    </aside>
    <div class="chat">
      <div class="chat-title">
        <div class="chat-title-profile-outer-frame">
          @if ($user->image && Storage::disk('public')->exists('profile_images/'.$user->image))
            <img class="chat-title-profile-inner-frame" src="{{ asset('storage/profile_images/'.$user->image) }}" alt="プロフィールの画像">
          @else
            <div class="chat-title-profile-no-image">
              <p>NO</p>
              <p>IMAGE</p>
            </div>
          @endif
        </div>
        <h1 class="chat-title-content">「購入者 or 出品者」さんとの取引画面</h1>
      </div>
      <div class="chat-item">
        <img src="{{ Storage::disk('public')->url('item_images/'.$purchasedItems->item->image) }}" width="200" height="200" alt="">
        <div class="chat-item-info">
          <h2 class="chat-item-info-name">商品名</h2>
          <p class="chat-item-info-price">¥6,000</p>
        </div>
      </div>
      <div class="chat-content">
        <ul class="chat-content-list">
          <li>ああああ</li>
          <li>いいいい</li>
          <li>うううう</li>
        </ul>
        <div class="chat-content-input">
          <form action="" method="">
            <input type="text">
            <button class="c-btn">画像を追加</button>
            <button class="c-btn">送信</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script>
  </script>
@endsection