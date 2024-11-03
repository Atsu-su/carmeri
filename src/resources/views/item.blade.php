@extends('layouts.base')
@section('title', '商品詳細')
@section('header')
  @include('components.header_switcher', ['headerType' => request()->headerType])
@endsection
@section('content')
<div id="item">
  <div class="item-img">
    @if ($item->image && Storage::disk('public')->exists('item_images/'.$item->image))
      <img src="{{ asset('storage/item_images/'.$item->image) }}" width="600" height="600" alt="{{ $item->name }}の画像">
    @else
      <img class="c-no-image" src="{{ asset('img/'.'no_image.jpg') }}">
    @endif
  </div>
  <div class="item-detail">
    <h1 class="item-detail-title">{{ $item->name }}</h1>
    <p class="item-detail-brand">{{ $item->brand }}</p>
    <p class="item-detail-price">¥<span>{{ number_format($item->price) }}</span> (税込)</p>
    <div class="item-detail-icons">
      <div class="item-detail-icons-icon item-detail-icons-like">
        <span>{{ $item->likes_count }}</span>
      </div>
      <div class="item-detail-icons-icon item-detail-icons-comment">
        <span>{{ $item->comments_count }}</span>
      </div>
    </div>
    <a href="" class="item-detail-btn c-btn c-btn--red c-btn--item">href-notyet 購入手続きへ</a>
    <h2 class="item-detail-title-about">商品説明</h2>
    <pre class="c-pre item-detail-about">{{ $item->description }}</pre>
    <h2 class="item-detail-title-general">商品の情報</h2>
    <table class="item-detail-general">
      <tr>
        <th>カテゴリ</th>
        <td>
          @foreach ($item->categoryItems as $categoryItem)
            <span class="c-label-category c-label-category--gray">{{ $categoryItem->category->category }}</span>
          @endforeach
        </td>
      </tr>
      <tr>
        <th>商品の状態</th>
        <td>{{ $item->condition->condition}}</td>
      </tr>
    </table>
    <div class="item-detail-comment">
      <h2 class="item-detail-comment-title">コメント({{ $item->comments_count}})</h2>

      {{-- ここからコメント --}}
      @foreach ($item->comments as $comment)
        <div class="item-detail-comment-commenter">
          <div class="item-detail-comment-commenter-frame">
            @if ($comment->user->image && Storage::disk('public')->exists('profile_images/'.$comment->user->image))
              <img src="{{ asset('storage/profile_images/'.$comment->user->image) }}" alt="プロフィールの画像">
            @else
              <p>NO</p>
              <p>IMAGE</p>
            @endif
          </div>
          <p class="item-detail-comment-commenter-user">{{ $comment->user->name }}</p>
        </div>
        <p class="item-detail-comment-body">{{ $comment->comment }}</p>
      @endforeach
      {{-- ここまでコメント --}}

      <h3 class="item-detail-comment-title-form">商品へのコメント</h3>
      @if (auth()->check())
      <div class="item-detail-comment-form">
        <form action="" method="post">
          <textarea name="comment" id="comment" cols="30" rows="10"></textarea>
          <button class="c-btn c-btn--item c-btn--red" type="submit">コメントを送信する</button>
        </form>
      </div>
      @else
      <p class="item-detail-comment-login">コメントをするには<a href="{{route('login')}}">ログイン</a>が必要です。</p>
      @endif
    </div>
  </div>
</div>
@endsection