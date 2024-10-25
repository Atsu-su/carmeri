@extends('layouts.base')
@section('title', 'Carmeri')
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
  <div class="c-items" id="index">
    <div class="titles">
      <h2 class="title title-recommend js-active-title" data-tab="first-tab">おすすめ</h2>
      <h2 class="title title-mylist" data-tab="second-tab">マイリスト</h2>
    </div>
    <div class="tab first-tab">
      <div class="c-item">
        {{-- <img src="" width="290" height="281" alt="【商品名】の画像"> --}}
        <div class="temp-img">商品画像</div>
        <p>商品名</p>
      </div>
      <div class="c-item">
        {{-- <img src="" width="290" height="281" alt="【商品名】の画像"> --}}
        <div class="temp-img">商品画像</div>
        <p>商品名</p>
      </div>
      <div class="c-item">
        {{-- <img src="" width="290" height="281" alt="【商品名】の画像"> --}}
        <div class="temp-img">商品画像</div>
        <p>商品名</p>
      </div>
      <div class="c-item">
        {{-- <img src="" width="290" height="281" alt="【商品名】の画像"> --}}
        <div class="temp-img">商品画像</div>
        <p>商品名</p>
      </div>
      <div class="c-item">
        {{-- <img src="" width="290" height="281" alt="【商品名】の画像"> --}}
        <div class="temp-img">商品画像</div>
        <p>商品名</p>
      </div>
      <div class="c-item">
        {{-- <img src="" width="290" height="281" alt="【商品名】の画像"> --}}
        <div class="temp-img">商品画像</div>
        <p>商品名</p>
      </div>
    </div>
    <div class="tab second-tab js-hidden">
      <div class="c-item">
        {{-- <img src="" width="290" height="281" alt="【商品名】の画像"> --}}
        <div class="temp-img">商品画像2</div>
        <p>商品名</p>
      </div>
      <div class="c-item">
        {{-- <img src="" width="290" height="281" alt="【商品名】の画像"> --}}
        <div class="temp-img">商品画像2</div>
        <p>商品名</p>
      </div>
      <div class="c-item">
        {{-- <img src="" width="290" height="281" alt="【商品名】の画像"> --}}
        <div class="temp-img">商品画像2</div>
        <p>商品名</p>
      </div>
    </div>
  </div>
  <script>
    const titles = document.querySelectorAll('.title');
    const tabs = document.querySelectorAll('.tab');

    titles.forEach(title => {
      title.addEventListener('click', (e) => {
        /* ・クリックされたタイトルにacitiveクラスが付いていない場合
             1. クリックされたタイトルにactiveクラスを付与
             2. クリックされなかったタイトルからactiveクラスを削除
             3. クリックされたタイトルに紐づくタブを表示
             4. クリックされなかったタイトルに紐づくタブを非表示

           ・クリックされたタイトルにactiveクラスが付いている場合、
             何もしない
        */
        if (! e.target.classList.contains('js-active-title')) {
          e.target.classList.add('js-active-title');

          titles.forEach(title => {
            if (e.target !== title) {
              title.classList.remove('js-active-title');
            }
          })

          tabs.forEach(tab => {
            if (tab.classList.contains(e.target.dataset.tab)) {
              tab.classList.remove('js-hidden');
            } else {
              tab.classList.add('js-hidden');
            }
          });
        }
      })
    })
  </script>
@endsection