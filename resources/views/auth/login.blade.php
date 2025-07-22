@extends('layouts.guest')

@section('content')
<div class="card ">
    <div class="card-body login-card-body">
         @if(session('error'))
        <div class="text-danger text-center">{{session('error')}}</div> {{-- if invalid credentials show error --}}
        @endif
        @if(session('success'))
        <div class="text-success text-center">{{session('success')}}</div> {{-- if invalid credentials show error --}}
        @endif
        <p class="login-box-msg">{{ __('Login') }}</p>
        <form action="{{ route('postLogin') }}" method="post">
            @csrf

            <div class="input-group mb-3">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('Email') }}" required autofocus>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
                @error('email')
                <span class="error invalid-feedback">
                    {{ $message }}
                </span>
                @enderror
            </div>

            <div class="input-group mb-3">
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}" required>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
                @error('password')
                <span class="error invalid-feedback">
                    {{ $message }}
                </span>
                @enderror
            </div>

            {{-- User Type Selection --}}
            <div class="input-group mb-3">
                <select name="user_type" class="form-control @error('user_type') is-invalid @enderror" required>
                    <option value="">{{ __('Select User Type') }}</option>
                    <option value="admin">{{ __('Admin') }}</option>
                    <option value="coop">{{ __('Coop') }}</option>
                    <option value="merchant">{{ __('Merchant') }}</option>
                    <option value="buyer">{{ __('Buyer') }}</option>
                </select>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user-tag"></span> {{-- You might need to adjust this icon --}}
                    </div>
                </div>
                @error('user_type')
                <span class="error invalid-feedback">
                    {{ $message }}
                </span>
                @enderror
            </div>
            {{-- End User Type Selection --}}

            <div class="row">
                <div class="col-8">
                    <div class="icheck-primary">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">{{ __('Login') }}</button>
                </div>
                </div>
        </form>

        @if (Route::has('password.request'))
            <p class="mb-1">
                <a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
            </p>
        @endif
    </div>
    </div>
@endsection