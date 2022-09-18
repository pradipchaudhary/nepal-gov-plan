@extends('layouts.app')

@section('content')
    <div class="login-card">
        <div class="container">
            <div class="row">
                <div class="login-card-header">
                    <div class="col-12 login-title">
                        <img class="gov-logo" src="{{ asset('emblem_nepal.png') }}">
                        <h3>{{ config('constant.SITE_NAME') }}</h3>
                        <h4>{{ config('constant.SITE_SUB_TYPE') }}</h4>
                        <p>{{ config('constant.FULL_ADDRESS') }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="row mb-1 mt-2">
                        <div class="col-md-12">
                            <label for="email" class="col-md-4 col-form-label"> <i class="fa-solid fa-user"></i>
                                {{ __('Username') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label for="password" class="col-md-4 col-form-label"> <i class="fa-solid fa-lock"></i>
                                {{ __('Password') }}</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-2 mt-3">
                        <div class="">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="">
                            <button type="submit" class="btn btn-block btn-primary" style="width:100%">
                                {{ __('लग-इन गर्नुहोस') }}
                            </button>

                            <!--@if (Route::has('password.request'))
    -->
                            <!--    <a class="btn btn-link" href="{{ route('password.request') }}">-->
                            <!--        {{ __('Forgot Your Password?') }}-->
                            <!--    </a>-->
                            <!--
    @endif-->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
