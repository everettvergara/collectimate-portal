@extends('layouts.app')

@section('content')
    <div class="login-container">
        <div class="container h-100">
            <div class="row align-items-center justify-content-center h-100">
                <div class="col-12 col-lg-7 mb-5 mt-5 mt-lg-0">
                    <img src="{{ asset('/storage/logo/logo.png') }}" alt="" class="mb-3 dashboard-logo">
                    <h1 class="text-center text-primary fw-bold" nonce="{{ csp_nonce() }}">Welcome to
                        {{ config('app.name') }} </h1>
                </div>
            </div>
        </div>
    </div>
@endsection
