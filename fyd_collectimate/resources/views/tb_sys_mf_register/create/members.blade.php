@extends('layouts.app2')

@section('content')
    <div class="bg-sub-section pt-5">
        <div class="container mb-5">
            <div class="text-center mb-3 mb-md-5 d-none">
                <a class="navbar-brand p-0" href="/">
                    @image([
                    'src' => '/storage/logo/isn_logo.png',
                    'width' => '120px',
                    ])
                    @endimage()
                </a>
            </div>
            <div class="row g-3 g-md-5 align-items-start position-relative">
                <div class="col-12 col-md-6 mb-3 position-sticky top-0 order-2 order-md-1">
                    <div class="splide" id="carouselExample">
                        <div class="splide__track">
                            <ul class="splide__list">
                                @foreach ($register_banners as $datum)
                                    <li class="splide__slide text-start text-sub-primary mb-2">
                                        <p class="w-100">{{ $datum->img_teaser }}</p>
                                        <div class="w-100 text-start">
                                            {!! html_entity_decode($datum->img_description) !!}
                                        </div>
                                        @image([
                                        'src' => asset('storage/images/Original/' . $datum->img_filename),
                                        'width' => '100%',
                                        'height' => '100%',
                                        'maxHeight' => '400px',
                                        'objectFit' => 'cover',
                                        ])
                                        @endimage()
                                        {{-- <div class="text-start w-100 my-3">
                                <a href="#" class="text-danger">Learn more</a>
                            </div> --}}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="col-12 col-md-6 mb-3 order-1 order-md-2 text-sub-primary">
                    <div class="mb-3 mb-md-4">
                        <h3>Create a {{ $type ?? '' }} Account</h3>
                    </div>

                    <form method="POST" action="{{ route('registers.store-member') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-2">
                            @text([
                            'name' => 'first_name',
                            'label' => 'First Name',
                            'label_class' => 'mb-1 text-sub-primary',
                            'col' => 'col-12 mb-3',
                            'input_class' => 'rounded-0 text-sub-primary',
                            'value' => old('first_name'),
                            'placeholder' => 'Enter your first name',
                            ])@endtext()

                            @text([
                            'name' => 'middle_name',
                            'label' => 'Middle Name',
                            'label_class' => 'mb-1 text-sub-primary',
                            'col' => 'col-12 mb-3',
                            'input_class' => 'rounded-0 text-sub-primary',
                            'value' => old('middle_name'),
                            'placeholder' => 'Enter your middle name',
                            ])@endtext()

                            @text([
                            'name' => 'last_name',
                            'label' => 'Last Name',
                            'label_class' => 'mb-1 text-sub-primary',
                            'col' => 'col-12 mb-3',
                            'input_class' => 'rounded-0 text-sub-primary',
                            'value' => old('last_name'),
                            'placeholder' => 'Enter your last name',
                            ])@endtext()

                            @text([
                            'name' => 'mobile_no',
                            'label' => 'Mobile No.',
                            'label_class' => 'mb-1 text-sub-primary',
                            'col' => 'col-12 mb-3',
                            'input_class' => 'rounded-0 text-sub-primary',
                            'value' => old('mobile_no'),
                            'placeholder' => 'Enter your mobile no',
                            ])@endtext()

                            @email([
                                'name' => 'email',
                                'label' => 'Email',
                                'label_class' => 'mb-1 text-sub-primary',
                                'col' => 'col-12 mb-3',
                                'input_class' => 'rounded-0 text-sub-primary',
                                'value' => old('email'),
                                'placeholder' => 'Enter your email',
                            ])@endtext()

                            @password([
                            'name' => 'password',
                            'label' => 'Password',
                            'label_class' => 'mb-1 text-sub-primary',
                            'col' => 'col-12 mb-3',
                            'input_class' => 'rounded-0 text-sub-primary',
                            'value' => old('password'),
                            'placeholder' => 'Enter your password',
                            'is_toggle' => 1
                            ])@endpassword()
                        </div>

                        <div class="mb-3">
                            <div class="mb-3 form-check">
                                <input type="hidden" name="is_understood" value="0" />
                                <input type="checkbox" class="form-check-input @error('is_understood') is-invalid @enderror"
                                    value="1" id="is_understood" name="is_understood">
                                <label class="form-check-label fs-7 text-sub-primary" for="is_understood"> I have
                                    understood and agreed to accept the <a href="{{ route('privacy_policy') }}"
                                        class="fw-bold text-sub-primary" target="_blank">Privacy Policy</a> of iSecure
                                    Networks.</label>
                            </div>

                            <div class="mb-3 form-check">
                                <input type="hidden" name="is_receive" value="0" />
                                <input type="checkbox" class="form-check-input @error('is_receive') is-invalid @enderror"
                                    value="1" id="is_receive" name="is_receive">
                                <label class="form-check-label fs-7 text-sub-primary" for="is_receive"> I would like
                                    to receive emails from iSecure Networks and its affiliates
                                    about promotions, products, industry resources, events and updates.</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary rounded-5 w-100 py-2">
                            Submit
                        </button>
                    </form>


                    <div class="my-3 my-md-4">
                        <a href="{{ route('passwords.forgot-password') }}" class="text-sub-primary fw-bold">Forgot your
                            password?</a>
                    </div>

                    <div class="border-top pt-3 pt-md-4 text-center">
                        <h5>Already have an account? <a href="/login" class="text-sub-primary fs-5 fw-bold">Login</a></h5>
                    </div>
                </div>
            </div>
            </section>
        </div>
        @footer()
        @endfooter()
    @endsection
    @section('scripts')
        <script nonce="{{ $cspNonce }}">
            @passwordjs([
                'name' => 'password',
            ]) @endpasswordjs()
        </script>

        <script nonce="{{ $cspNonce }}">
            document.addEventListener('DOMContentLoaded', function() {
                new Splide('#carouselExample', {
                    type: 'loop',
                    perPage: 1,
                    autoplay: true,
                    interval: 3000,
                    speed: 500,
                    pagination: true,
                    arrows: false,
                    drag: false,
                    height: 'auto',
                    pauseOnHover: false,
                }).mount();
            });
        </script>
    @endsection()
