@extends('layouts.app')
@section('css-link')
    <link rel="stylesheet" href="styles/auth/auth.css">
@endsection

@section('content')
    {{-- <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}


    {{-- <div class="my-container">
        @error('email')
            <div class="alert alert-danger my-3" role="alert">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
        @error('password')
            <div class="alert alert-danger my-3" role="alert">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
        <div class="screen">
            <div class="screen__content">
                <form class="login">
                    @csrf
                    <div class="login__field" style="z-index: 5 !important;">
                        <i class="login__icon bi bi-person-fill"></i>
                        <input type="email" class="login__input @error('email') is-invalid @enderror"
                            placeholder="Email" value="{{ old('email') }}" name="email">

                    </div>
                    <div class="login__field">
                        <i class="login__icon bi bi-lock-fill"></i>
                        <input type="password" class="login__input @error('password') is-invalid @enderror"
                            placeholder="Password" name="password" required >
                    </div>
                    <button class="button login__submit" type="submit">
                        <span class="button__text">Login</span>
                        <i class="button__icon fas fa-chevron-right"></i>
                    </button>
                    <button class="button login__submit">
                        <a href="/register">
                            <span class="button__text">Register<span>
                                    <i class="button__icon fas fa-chevron-right"></i>
                        </a>
                    </button>
                </form>
                <div class="screen__background">
                    <span class="screen__background__shape screen__background__shape4"></span>
                    <span class="screen__background__shape screen__background__shape3"></span>
                    <span class="screen__background__shape screen__background__shape2"></span>
                    <span class="screen__background__shape screen__background__shape1"></span>
                </div>
            </div>
        </div> --}}

    <div class="container">
        @error('email')
            <div class="alert alert-danger my-3" role="alert">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
        @error('password')
            <div class="alert alert-danger my-3" role="alert">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
        <div class="login-box">
            <h2>Login</h2>
            <form>
                @csrf
                <div class="user-box">
                    <input type="email" class="@error('email') is-invalid @enderror"  placeholder="Email"
                         name="email" required>
                    <label>Email</label>
                </div>
                <div class="user-box">
                    <input type="password" class="@error('password') is-invalid @enderror" placeholder="Password"
                        name="password" required>
                    <label>Password</label>
                </div>
                <div>
                    <button type="submit" class="btn btn-outline-light">LOGIN</button>
                    <small class="mx-3 text-light">Don't have an account <a href="register">register here</a></small>
                </div>
                    

            </form>
        </div>
    </div>
@endsection
