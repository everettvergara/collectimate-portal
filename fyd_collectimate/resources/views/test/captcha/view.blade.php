@extends('layouts.app2')
@section('head')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection()
@section('content')
    <div class="container-fluid px-3 px-md-5">
        <div class="card no-shadow mt-3 mb-3 overflow-hidden rounded-3 bg-white">
            <div class="card-body rounded-3 p-3 p-lg-4">

                <div class="mb-3 mb-md-4 pb-2 border-bottom">
                    <h6 class="mb-0">{{ 'TEST PROMOTIONS' }} </h6>
                </div>
                <form method="POST" action="{{ route('tests.captcha-submit') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_CAPTCHA_SITE_KEY') }}"></div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-md btn-danger">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script nonce="{{ $cspNonce }}">
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    </script>
@endsection
