@extends('layouts.empty')

@section('content')
    <div class="login-container">
        <div class="container h-100">
            <div class="row align-items-center justify-content-center h-100">
                <div class="col-12 col-lg-7 mb-5 mt-5 mt-lg-0">
                    <img src="{{ asset('/storage/logo/logo.png') }}" alt="" class="mb-3"
                        style="
							width: auto;
							height: 100%;
							max-width: 100%;
							max-height: 80px;
							display: block;
							margin: 0 auto;
					">
                    <h1 class="text-center text-primary">Welcome to {{ config('app.name') }}</h1>
                </div>
                <div class="col-12 col-md-8 col-lg-5 mb-5 mb-lg-0">
                    <div class="card text-secondary rounded-4 border-0">
                        <div class="card-body p-4 p-lg-5 my-3 my-lg-5 mx-2">
                            <div
                                class="d-flex flex-column align-items-center justify-content-center mb-3 mb-md-4 overflow-hidden">
                                <h3 class="text-black text-center fw-normal inter mb-3 mb-md-4">
                                    {{ __('Forgot your password?') }}</h3>
                                <p class="text-secondary m-0 fw-normal inter text-center">Enter your email below to receive
                                    your password
                                    reset instructions.</p>
                            </div>
                            <form method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-4">
                                    <label for="email"
                                        class="form-label text-secondary mb-1">{{ __('Username') }}</label>
                                    <input id="email" type="email"
                                        class="form-control form-control-lg rounded-5 @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" autofocus>
                                </div>

                                <div class="mb-2">
                                    <button type="submit" formaction="{{ route('passwords.send') }}"
                                        class="btn btn-md btn-danger w-100 rounded-5 text-white">
                                        {{ __('Submit') }}
                                    </button>
                                </div>
                                <div class="mt-3">
                                    <a href="/login" class="text-decoration-none text-primary">Login Now</a>
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
    <script nonce="{{ $cspNonce }}"></script>
@endsection()
