@extends('layouts.empty')

@section('content')
    <div class="login-container">
        <div class="container h-100">
            <div class="row align-items-center justify-content-center h-100">
                <div class="col-12 col-lg-7 mb-5 mt-5 mt-lg-0">
                    <img src="{{ asset('/storage/logo/logo.png') }}" alt="" class="mb-3 login-logo">
                    <h1 class="text-center text-primary">Welcome to {{ config('app.name') }}</h1>
                </div>
                <div class="col-12 col-md-8 col-lg-5 mb-5 mb-lg-0">
                    <div class="card text-secondary rounded-4 border-0">
                        <div class="card-body p-4 p-lg-5 my-3 my-lg-5 mx-2">
                            <div
                                class="d-flex flex-column align-items-center justify-content-center mb-3 mb-md-4 overflow-hidden">
                                <h3 class="text-black m-0 fw-normal inter">Login</h3>
                            </div>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="code"
                                        class="form-label mb-1 text-secondary ">{{ __('Username') }}</label>
                                    <input id="code" type="text" class="form-control form-control-lg rounded-5"
                                        name="code" value="{{ old('code') }}" placeholder="Enter your username"
                                        autofocus>
                                </div>

                                <div class="mb-3">
                                    <label for="password"
                                        class="form-label mb-1 text-secondary ">{{ __('Password') }}</label>
                                    <div>
                                        <div class="input-group">
                                            <input type="password"
                                                class="form-control form-control-lg rounded-start-5 border-end-0 @error('password') is-invalid @enderror"
                                                id="password" name="password" required autocomplete="current-password"
                                                placeholder="Enter your password">
                                            <span class="input-group-text rounded-end-5 bg-transparent"><i
                                                    class="fa fa-eye text-dark cursor-pointer"
                                                    id="togglePassword"></i></span>
                                        </div>

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 mt-4">
                                    <button type="submit" class="btn btn-md btn-danger w-100 rounded-5 text-white">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                                <div class="mb-3 d-flex align-items-center justify-content-between">
                                    <div class="form-check d-none">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label text-dark fs-12p" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                    <div class="">
                                        <span class="text-secondary">Forgot your password?</span>
                                        <a href="{{ route('passwords.forgot-password') }}"
                                            class=" text-decoration-none text-primary ms-1">click here</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script nonce="{{ $cspNonce }}">
        @passwordjs([
            'name' => 'password'
        ])
        @endpasswordjs()
    </script>
@endsection()
