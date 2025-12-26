@extends('layouts.empty')

@section('content')
    <section class="p-0">
        <div class="container vh-100">
            <div class="row g-2 g-md-3 h-100 align-items-center justify-content-center">
                <div class="col-12 col-md-6 mb-3">
                    <div class="text-center">
                        <h1 class="fw-bold mb-3">Thanks for signing up!</h1>
                        <h5 class="mb-1">We've sent an verification email to:</h5>
                        <a href="mailto:{{ $email ?? '' }}" class="text-black fw-bold mb-3 mb-md-4">{{ $email ?? '' }}</a>
                    </div>
                    <div class="text-center mt-4 mt-md-5">
                        <p class="mb-2">Just click on the link in that email to complete your signup. If you don't see it.
                            you may need to <strong>check your spam</strong> folder.</p>
                        <p>still can't find email? No problem</p>
                        <a href="{{ route('registers.resend-email', ['user' => $user_id]) }}"
                            class="btn btn-md btn-primary rounded-5 fs-7 px-3 px-md-4 me-0 me-md-2 mb-2">Resend Verification
                            Email</a>
                        <a href="{{ route('home') }}"
                            class="btn btn-outline-black rounded-0 btn-md fs-7 px-3 px-md-4 mb-2">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
