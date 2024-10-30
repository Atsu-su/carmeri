@extends('layouts.base')
@section('title', '住所変更')
@section('header')
  @include('components.header_switcher', ['headerType' => 'logOut'])
@endsection
@section('content')
  <div class="c-default-form" id="login">
    <h1 class="title">住所の変更</h1>
    <form class="form" action="post">
      <h2 class="form-title">郵便番号</h2>
      <input class="form-input" type="text">
      <h2 class="form-title">住所</h2>
      <input class="form-input" type="text">
      <h2 class="form-title">建物名</h2>
      <input class="form-input" type="text">
      <button class="form-btn c-btn c-btn--red" type="submit">更新する</button>
    </form>
  </div>
@endsection