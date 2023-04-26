@extends('layouts.app')
@section('css-link')
    <link rel="stylesheet" href="styles/auth/auth.css">
@endsection
@section('content')
    {{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

    <div class="container">
        <div class="login-box my-2">
            <h2>Register</h2>
            <div class="my-2">
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
                @error('name')
                    <div class="alert alert-danger my-3" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
                @error('phone_number')
                    <div class="alert alert-danger my-3" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
            </div>
            <form method="post">
                @csrf
                <div class="user-box">
                    <input type="text" class="@error('name') is-invalid @enderror" placeholder="Name" name="name"
                        required>
                    <label>Name</label>
                </div>
                <div class="user-box">
                    <input type="tele" class="@error('phone_number') is-invalid @enderror" placeholder="Phone Number"
                        name="phone_number" required>
                    <label>Phone Number</label>
                </div>
                <div class="user-box">
                    <input type="email" class="@error('email') is-invalid @enderror" placeholder="Email" name="email"
                        required>
                    <label>Email</label>
                </div>
                <div class="user-box">
                    <input type="password" class="@error('password') is-invalid @enderror" placeholder="Password"
                        name="password" required>
                    <label>Password</label>
                </div>
                <div class="user-box">
                    <input type="password"name="password_confirmation" required autocomplete="new-password"
                        placeholder="Confirm Password">
                    <label>Confirm Password</label>
                </div>
                <div>
                    <button type="submit" class="btn btn-outline-light">REGISTER</button>
                    <small class="mx-3 text-light">You have an account <a href="login">login here</a></small>
                </div>
            </form>
            
        </div>
    </div>
@endsection
