@extends('layouts.base')
@section('title', 'プロフィール入力')
@section('header')
  @include('components.header_switcher', ['headerType' => 'logOut'])
@endsection
@section('content')
  <div id="profile" class="c-default-form">
    {{--
    @ifで分岐する（初回と編集）
    $referer =  $request->headers->get('referer');で取得して、
    遷移元のページによって分岐させる
    --}}
    <h1 class="title">プロフィール設定</h1>
    <h1 class="title" style="display: none">プロフィール編集</h1>
    {{-- ここまで --}}
    <form class="form" action="" method="post" enctype="multipart/form-data">
      @csrf
      {{-- c-default影響範囲外 ここから --}}
      <div class="img-upload">
        <div id="background" class="img-upload-preview">
          <img id="preview" src="" width="100" height="100">
        </div>
        <label class="c-btn-img-select c-btn-img-select--profile" for="img-input">
          画像を選択する
        </label>
        <input class="img-upload-input" id="img-input" type="file" name="image" accept="image/*" style="display: none"/>
        <button class="img-upload-reset c-btn-img-reset c-btn-img-reset--profile" id="reset-btn" type="button">画像を削除</button>
      </div>
      {{-- ここまで c-default影響範囲外 --}}
      <span class="img-upload-file-name" id="file-name"></span>
      <h2 class="form-title">ユーザー名</h2>
      <input class="form-input" type="text">
      <h2 class="form-title">郵便番号</h2>
      <input class="form-input" type="text">
      <h2 class="form-title">住所</h2>
      <input class="form-input" type="text">
      <h2 class="form-title">建物名</h2>
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