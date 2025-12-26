@extends('layouts.app2')

@section('content')
    <section class="bg-sub-section">
        <div class="container">
            <div class="text-center mb-3 mb-md-5 d-none">
                <a class="navbar-brand p-0" href="/">
                    @image([
                    'src' => '/storage/logo/logo.png',
                    'width' => '120px',
                    ])
                    @endimage()
                </a>
            </div>
    </section>
    @footer()
    @endfooter()
    </div>
@endsection
@section('scripts')
    <script nonce="{{ $cspNonce }}">
        @passwordjs([
            'name' => 'password'
        ])
        @endpasswordjs()
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
