@extends('layouts.base')
@section('title', 'ユーザ登録')
@section('header')
  @include('components.header')
@endsection
@section('content')
  <div id="card" class="">
    @if (session('flash_alert'))
      <p class="alert alert-danger">{{ session('flash_alert') }}</p>
    @elseif(session('status'))
      <p class="alert alert-success">{{ session('status') }}</p>
    @endif
    <h1 class="">Stripe決済</h1>
    <form id="card-form" action="{{ route('payment.store') }}" method="POST">
      @csrf
      <div>
        <label>カード番号</label>
        <div id="card-number" class=""></div>
      </div>
      <div>
        <label>有効期限</label>
        <div id="card-expiry" class=""></div>
      </div>
      <div>
        <label>セキュリティコード</label>
        <div id="card-cvc" class=""></div>
      </div>

      <p id="card-errors" class=""></p>
      <button class="">支払い</button>
    </form>
  </div>

  {{-- Stripe --}}
  <script src="https://js.stripe.com/v3/"></script>
  <script>
  /* 基本設定*/
    const stripe_public_key = "{{ config('stripe.stripe_public_key') }}"
    const stripe = Stripe(stripe_public_key);
    const elements = stripe.elements();

    var cardNumber = elements.create('cardNumber');
    cardNumber.mount('#card-number');
    cardNumber.on('change', function(event) {
      var displayError = document.getElementById('card-errors');
      if (event.error) {
        displayError.textContent = event.error.message;
      } else {
        displayError.textContent = '';
      }
    });

    var cardExpiry = elements.create('cardExpiry');
    cardExpiry.mount('#card-expiry');
    cardExpiry.on('change', function(event) {
      var displayError = document.getElementById('card-errors');
      if (event.error) {
        displayError.textContent = event.error.message;
      } else {
        displayError.textContent = '';
      }
    });

    var cardCvc = elements.create('cardCvc');
    cardCvc.mount('#card-cvc');
    cardCvc.on('change', function(event) {
      var displayError = document.getElementById('card-errors');
      if (event.error) {
        displayError.textContent = event.error.message;
      } else {
        displayError.textContent = '';
      }
    });

    var form = document.getElementById('card-form');
    form.addEventListener('submit', function(event) {
      event.preventDefault();
      var errorElement = document.getElementById('card-errors');
      if (event.error) {
        errorElement.textContent = event.error.message;
      } else {
        errorElement.textContent = '';
      }

      stripe.createToken(cardNumber).then(function(result) {
        if (result.error) {
          errorElement.textContent = result.error.message;
        } else {
          stripeTokenHandler(result.token);
        }
      });
    });

    function stripeTokenHandler(token) {
      var form = document.getElementById('card-form');
      var hiddenInput = document.createElement('input');
      hiddenInput.setAttribute('type', 'hidden');
      hiddenInput.setAttribute('name', 'stripeToken');
      hiddenInput.setAttribute('value', token.id);
      form.appendChild(hiddenInput);
      form.submit();
    }
  </script>
@endsection