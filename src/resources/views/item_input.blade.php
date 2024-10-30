@extends('layouts.base')
@section('title', '商品の出品')
@section('header')
  @include('components.header_switcher', ['headerType' => 'logOut'])
@endsection
@section('content')
  <div id="item-input">
    <h1 class="title">商品の出品</h1>
    <form class="form" action="" method="post" enctype="multipart/form-data">
      @csrf
      <div class="img-upload">
        <h2 class="img-upload-title">商品の画像</h2>
        <div class="img-upload-container">
          <div id="background" class="img-upload-background">
            <img id="preview" src="" width="100" height="100">
          </div>
          <label id="label" class="img-upload-img-select c-btn-img-select c-btn-img-select--profile" for="img-input">
            画像を選択する
          </label>
          <input class="img-upload-input" id="img-input" type="file" name="image" accept="image/*"/>
        </div>
        <p class="img-upload-file-name" id="file-name"></p>
        <button class="img-upload-reset c-btn-img-reset c-btn-img-reset--profile" id="reset-btn" type="button">画像を削除</button>
      </div>
      <h2 class="form-title">商品の詳細</h2>
      <h3 class="form-name form-name-category">カテゴリ</h3>
      <div class="form-category">
        <input type="checkbox" id="1" value="1" name="category[]">
        <label for="1">ファッション</label>
        <input type="checkbox" id="2" value="2" name="category[]">
        <label for="2">家電</label>
        <input type="checkbox" id="3" value="3" name="category[]">
        <label for="3">インテリア</label>
        <input type="checkbox" id="4" value="4" name="category[]">
        <label for="4">スポーツ</label>
        <input type="checkbox" id="5" value="5" name="category[]">
        <label for="5">ガーデニング</label>
        <input type="checkbox" id="6" value="6" name="category[]">
        <label for="6">トレーニング</label>
        <input type="checkbox" id="7" value="7" name="category[]">
        <label for="7">書籍</label>
        <input type="checkbox" id="8" value="8" name="category[]">
        <label for="8">車関係</label>
      </div>
      <h3 class="form-name form-name-condition">商品の状態</h3>
      <div class="form-condition-wrapper">
        <select class="form-condition" name="condition" id="">
          <option value="0">選択してください</option>
          <option value="1">良好</option>
          <option value="2">目立った傷や汚れはなし</option>
          <option value="3">やや傷や汚れあり</option>
          <option value="4">状態が悪い</option>
        </select>
      </div>
      <h2 class="form-title">商品名と説明</h2>
      <h3 class="form-name">商品名</h3>
      <input class="form-input" type="text" name="item-name">
      <h3 class="form-name">商品の説明</h3>
      <textarea class="form-textarea" name="about-item"></textarea>
      <h3 class="form-name">販売価格</h3>
      <div class="form-price-wrapper">
        <input class="form-input form-input-price" type="text" name="price">
      </div>
      <button class="form-btn c-btn c-btn--red" type="submit">登録する</button>
    </form>
  </div>
  {{-- 画像プレビュー --}}
  <script>
      const imgInput = document.getElementById('img-input');
      const preview = document.getElementById('preview');
      const background = document.querySelector('.img-upload-background');
      const resetBtn = document.getElementById('reset-btn');
      const fileName = document.getElementById('file-name');
      const label = document.getElementById('label');

      imgInput.addEventListener('change', function(event) {
          const file = event.target.files[0];

          if (file && file.type.startsWith('image/')) {
              const reader = new FileReader();

              // ロード後の処理
              reader.onload = function(e) {
                  preview.src = e.target.result;
                  preview.style.display = 'block';
                  background.style.display = 'block';
                  resetBtn.style.display = 'block';
                  label.style.display = 'none';
                  filename.textContent = `ファイル：${file.name}`;
              }

              reader.readAsDataURL(file);
          }
      });

      function resetPreview() {
          preview.src = '';
          preview.style.display = 'none';
          background.style.backgroundColor = '#D9D9D9';
          resetBtn.style.display = 'none';
          imgInput.value = ''; // ファイル入力をクリア（POSTされる値）
          fileName.textContent = ''; // ファイル名をクリア
          label.style.display = 'grid';
          background.style.display = 'none';
      }

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