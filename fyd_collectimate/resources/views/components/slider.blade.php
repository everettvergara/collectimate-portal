<div class="splide" id="customSlider">
    <div class="splide__track provider" style="height: 500px!important;">
        <ul class="splide__list">
            @foreach ($data as $datum)
                <li class="splide__slide text-black"
                    style="background-image: url({{ asset('storage/images/Original/' . $datum->banner_image_name) }});">
                    <div class="container d-none">
                        <div class="row">
                            <div class="col-12 col-lg-6 col-xl-5 py-4">
                                <div class="mb-3">
                                    <h1 class="fw-bold m-0">{{ $datum->name }}</h1>
                                </div>
                                <p class="mb-4">{{ $datum->description }}</p>
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>

<script nonce="{{ $cspNonce }}">
    document.addEventListener('DOMContentLoaded', function() {
        new Splide('#customSlider', {
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
