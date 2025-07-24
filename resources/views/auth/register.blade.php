@extends('layouts.guest')

@section('content')
<body class="hold-transition login-page layout-fixed">
    <div class="login-box">
        <div class="login-logo">
            <a href="/">{{ config('app.name', 'eMerkado') }}</a>
        </div>
        <!-- /.login-logo -->
        <div class="card ">
            <div class="card-body login-card-body">
                <p class="login-box-msg">{{ __('Register As:') }}</p>

                <div class="row">
                    <div class="col-12 mb-3">
                        <a href="{{ route('coop.auth.register') }}" class="btn btn-primary btn-block fas">
                            {{ __('Coop') }}
                            <i class="nav-icon fas fa-store"></i>
                        </a>
                    </div>
                    <div class="col-12 mb-3">
                        <a href="{{ route('merchant.auth.register') }}" class="btn btn-primary btn-block fas">
                            {{ __('Merchant') }}
                            <i class="nav-icon fas fa-comments-dollar"></i>
                        </a>
                    </div>
                    <div class="col-12 mb-3">
                        <a href="{{ route('buyer.auth.register') }}" class="btn btn-primary btn-block fas">
                            {{ __('Buyer') }}
                            <i class="nav-icon fas fa-store"></i>
                        </a>
                    </div>
                </div>

                <p class="mb-1 text-center">
                    <a href="{{ route('getLogin') }}">{{ __('I already have a membership') }}</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
</div>
@endsection
