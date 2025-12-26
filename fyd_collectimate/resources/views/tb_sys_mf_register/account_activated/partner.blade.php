@extends('layouts.empty')

@section('content')
    <section class="p-0">
        <div class="container vh-100">
            <div class="row g-2 g-md-3 h-100 align-items-center justify-content-center">
                <div class="col-12 col-md-6 mb-3">
                    <div class="text-center mb-3 mb-md-5">
                        <h1 class="mb-3 mb-md-4">Account Activated</h1>
                        <h5 class="mb-3 mb-md-4">This account has already been confirmed. You may click on the link below to
                            log in now</h5>
                        <a href="{{ route('login.partner-show') }}"
                            class="btn btn-black rounded-0 btn-lg fs-6 px-3 px-md-4">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
