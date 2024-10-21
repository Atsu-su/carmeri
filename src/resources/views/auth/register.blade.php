@extends('layouts.base')
@section('title', 'ユーザ登録')
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
  <div class="c-default-form" id="register">
    <h1 class="title">会員登録</h1>
    <form class="form" action="post">
      <h2 class="form-title">ユーザ名</h2>
      <input class="form-input" type="text">
      <h2 class="form-title">メールアドレス</h2>
      <input class="form-input" type="text">
      <h2 class="form-title">パスワード</h2>
      <input class="form-input" type="password">
      <h2 class="form-title">確認用パスワード</h2>
      <input class="form-input" type="password">
      <button class="form-btn c-btn c-btn--red" type="submit">登録する</button>
    </form>
    <a class="login-link u-opacity-08" href="">ログインはこちら</a>
  </div>
@endsection