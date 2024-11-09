@extends('layouts.base')
@section('title', 'ログイン')
@section('header')
  @include('components.header')
@endsection
@section('content')
  <div class="c-default-form" id="login">
    <h1 class="title">ログイン</h1>
    <form class="form" action="{{ route('login') }}" method="post">
      @csrf
      <h2 class="form-title">メールアドレス</h2>
      <input class="form-input" type="text" name="email" value="{{ old('email', \App\Models\User::query()->where('id', 1)->select('email')->first()->email) }}">
      @error('email')
        <p class="c-error-message">{{ $message }}</p>
      @enderror
      <h2 class="form-title">パスワード</h2>
      <input class="form-input" type="password" name="password" value="{{ old('password', 'password') }}">
      @error('password')
        <p class="c-error-message">{{ $message }}</p>
      @enderror
      <button class="form-btn c-btn c-btn--red" type="submit">ログインする</button>
    </form>
    <a class="login-link u-opacity-08" href="">会員登録はこちら</a>
  </div>
@endsection