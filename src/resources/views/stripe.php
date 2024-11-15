@extends('layouts.base')
@section('title', 'カード情報入力')
@section('header')
  @include('components.header')
@endsection
@section('content')
<style>
    input {
        height: 50px;
        background-color: red;
        border:1px solid #ccc;
    }
</style>
    <div class="container">
        @if (session('flash_alert'))
            <div class="alert alert-danger">{{ session('flash_alert') }}</div>
        @elseif(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="p-5">
            <div class="col-6 card">
                <div class="card-header">Stripe決済</div>
                <div class="card-body">
                    <form id="card-form" action="{{ route('payment.store') }}" method="POST">
                        @csrf
                        <div>
                            <label for="card_number">カード番号</label>
                            <div id="card-number" class="form-control"></div>
                        </div>

                        <div>
                            <label for="card_expiry">有効期限</label>
                            <div id="card-expiry" class="form-control"></div>
                        </div>

                        <div>
                            <label for="card-cvc">セキュリティコード</label>
                            <div id="card-cvc" class="form-control"></div>
                        </div>

                        <div id="card-errors" class="text-danger"></div>

                        <button class="mt-3 btn btn-primary">支払い</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        /* 基本設定*/
        const stripe_public_key = "{{ config('stripe.stripe_public_key') }}"
        const stripe = Stripe(stripe_public_key);
        const elements = stripe.elements();

        var cardNumber = elements.create('cardNumber');
        cardNumber.mount('#card-number');
        console.log('cardNumber');
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