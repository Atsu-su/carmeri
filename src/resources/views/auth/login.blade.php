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
  <div class="c-default-form" id="login">
    <h1 class="title">ログイン</h1>
    <form class="form" action="post">
      <h2 class="form-title">メールアドレス</h2>
      <input class="form-input" type="text">
      <h2 class="form-title">パスワード</h2>
      <input class="form-input" type="password">
      <button class="form-btn c-btn c-btn--red" type="submit">ログインする</button>
    </form>
    <a class="login-link u-opacity-08" href="">会員登録はこちら</a>
  </div>
@endsection