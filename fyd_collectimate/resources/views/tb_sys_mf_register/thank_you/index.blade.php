@extends('layouts.logo_only')

@section('content')
    <section class="border-bottom p-0">
        <div class="container vh-100">
            <div class="row g-2 g-md-3 h-100 align-items-center justify-content-center">
                <div class="col-12 col-md-6 mb-3">
                    @image([
                    'src' => '/storage/images/Original/img.webp',
                    'width' => '90%',
                    'height' => 'unset',
                    ])
                    @endimage()

                </div>
                <div class="col-12 col-md-6 mb-3">
                    <h1>Thank you for registering!</h1>
                    <p>We're excited to have you on board and look forward to providing you with the best experience.</p>
                    <a href="/login" class="btn btn-black rounded-0 btn-lg fs-6 px-3 px-md-4">Login</a>
                </div>
            </div>
        </div>
    </section>
    @footer()
    @endfooter()
@endsection
