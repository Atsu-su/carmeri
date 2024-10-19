@extends('layouts.base')
@section('title', '')
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
  <div id="profile">
    <h1 class="title">プロフィール設定</h1>
    <div class="upload-img">
      <form action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="upload-img-form-select">
          <label for="file-upload">画像を選択する</label>
          <input id="file-upload" type="file" name="image" accept="image/*" style="display: none"/>
          <span id="file-name"></span>
        </div>
        <button type="submit">画像をアップロード</button>
      </form>
    </div>
    <form class="form" action="post">
      <h2 class="form-title">ユーザー名</h2>
      <input class="form-input" type="text">
      <h2 class="form-title">郵便番号</h2>
      <input class="form-input" type="text">
      <h2 class="form-title">住所</h2>
      <input class="form-input" type="password">
      <h2 class="form-title">建物名</h2>
      <input class="form-input" type="password">
      <button class="form-btn c-btn c-btn--red" type="submit">登録する</button>
    </form>
    <a class="login-link u-opacity-08" href="">ログインはこちら</a>
  </div>
  <script>
    document.getElementById('file-upload').addEventListener('change', function() {
        var fileName = this.files[0] ? this.files[0].name : '';
        document.getElementById('file-name').textContent = fileName;
    });
</script>
@endsection