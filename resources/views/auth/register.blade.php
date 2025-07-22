@extends('layouts.guest')

@section('content')
<div class="card ">
    <div class="card-body login-card-body">
        <p class="login-box-msg">{{ __('Register As:') }}</p>

        <div class="row">
            <div class="col-12 mb-3">
                <a href="{{ route('coop.auth.register') }}" class="btn btn-primary btn-block">
                    {{ __('Coop') }}
                </a>
            </div>
            <div class="col-12 mb-3">
                <a href="{{ route('merchant.auth.register') }}" class="btn btn-primary btn-block">
                    {{ __('Merchant') }}
                </a>
            </div>
            <div class="col-12 mb-3">
                <a href="{{ route('buyer.auth.register') }}" class="btn btn-primary btn-block">
                    {{ __('Buyer') }}
                </a>
            </div>
        </div>

        <p class="mb-1 text-center">
            <a href="{{ route('getLogin') }}">{{ __('I already have a membership') }}</a>
        </p>
    </div>
    <!-- /.login-card-body -->
</div>
@endsection
