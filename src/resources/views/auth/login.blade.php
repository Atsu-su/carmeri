@extends('layouts.base')
@section('title', 'ログイン')
@section('header')
  @include('components.header_switcher', ['headerType' => ''])
@endsection
@section('content')
  <div class="c-default-form" id="login">
    <h1 class="title">ログイン</h1>
    <form class="form" action="{{ route('login') }}" method="post">
      @csrf
      <h2 class="form-title">メールアドレス</h2>
      <input class="form-input" type="text" name="email" value="sasada.yoko@example.com">
      <h2 class="form-title">パスワード</h2>
      <input class="form-input" type="password" name="password" value="password">
      <button class="form-btn c-btn c-btn--red" type="submit">ログインする</button>
    </form>
    <a class="login-link u-opacity-08" href="">会員登録はこちら</a>
  </div>
@endsection