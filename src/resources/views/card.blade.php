@extends('layouts.base')
@section('title', 'カード情報入力')
@section('header')
  @include('components.header')
@endsection
@section('content')
<div id="login" class="c-default-form">
  <h1 class="title">決済情報入力</h1>
  <form class="form" action="" method="post">
    @csrf
    <h2 class="form-title">カード番号</h2>
    <input class="form-input" type="text" name="card_number">
    @error('email')
      <p class="c-error-message">{{ $message }}</p>
    @enderror
    <h2 class="form-title">有効期限</h2>
    <input class="form-input" type="password" name="expiry_date">
    @error('password')
      <p class="c-error-message">{{ $message }}</p>
    @enderror
    <h2 class="form-title">CVC情報</h2>
    <input class="form-input" type="password" name="cvc">
    @error('password')
      <p class="c-error-message">{{ $message }}</p>
    @enderror
    <button class="form-btn c-btn c-btn--red" type="submit">カード情報を送信</button>
  </form>
</div>
@endsection