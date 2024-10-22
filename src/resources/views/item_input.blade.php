@extends('layouts.base')
@section('title', 'プロフィール入力')
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
  <div id="item-input">
    <h1 class="title">商品の出品</h1>
    <form class="form" action="" method="post" enctype="multipart/form-data">
      @csrf
      <div class="img-upload">
        <h2 class="img-upload-title">商品の画像</h2>
        <div class="img-upload-container">
          <div id="background" class="img-upload-preview">
            <img id="preview" src="" width="100" height="100">
          </div>
          <label class="img-upload-img-select c-btn-img-select c-btn-img-select--profile" for="img-input">
            画像を選択する
          </label>
          <input class="img-upload-input" id="img-input" type="file" name="image" accept="image/*" style="display: none"/>
          <button class="img-upload-reset c-btn-img-reset c-btn-img-reset--profile" id="reset-btn" type="button">画像を削除</button>
        </div>
        <span class="img-upload-file-name" id="file-name"></span>
      </div>
      <h2 class="form-title">商品の詳細</h2>
      <h3 class="form-name">カテゴリ</h3>
      <h3 class="form-name">商品の状態</h3>
      <h2 class="form-title">商品名と説明</h2>
      <h3 class="form-name">商品名</h3>
      <input class="form-input" type="text">
      <h3 class="form-name">商品の説明</h3>
      <textarea name="" id=""></textarea>
      <h3 class="form-name">販売価格</h3>
      <input class="form-input" type="text">
      <button class="form-btn c-btn c-btn--red" type="submit">登録する</button>
    </form>
  </div>
  {{-- 画像プレビュー --}}
  <script>
      const imgInput = document.getElementById('img-input');
      const preview = document.getElementById('preview');
      const background = document.getElementById('background');
      const resetBtn = document.getElementById('reset-btn');
      const fileName = document.getElementById('file-name');

      function resetPreview() {
          preview.src = '';
          preview.style.display = 'none';
          background.style.backgroundColor = '#D9D9D9';
          resetBtn.style.display = 'none';
          imgInput.value = ''; // ファイル入力をクリア（POSTされる値）
          fileName.textContent = ''; // ファイル名をクリア
      }

      imgInput.addEventListener('change', function(event) {
          const file = event.target.files[0];

          if (file && file.type.startsWith('image/')) {
              const reader = new FileReader();

              reader.onload = function(e) {
                  preview.src = e.target.result;
                  preview.style.display = 'block';
                  background.style.backgroundColor = 'transparent';
              }

              reader.readAsDataURL(file);
              resetBtn.style.display = 'block';
          } else {
              preview.src = '';
              preview.style.display = 'none';
              background.style.backgroundColor = '#D9D9D9';
          }
      });

      resetBtn.addEventListener('click', resetPreview);

  </script>

  {{-- 画像選択後にファイル名を表示 --}}
  <script>
    document.getElementById('img-input').addEventListener('change', function() {
        var fileName = this.files[0] ? this.files[0].name : '';
        document.getElementById('file-name').textContent = `ファイル：${fileName}`;
    });
  </script>
@endsection