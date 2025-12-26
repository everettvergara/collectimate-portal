<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ asset('/storage/favicon/apple-touch-icon.png') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    {{-- <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ asset('/css/nunito.css') }}">
    {{-- <link href="https://fonts.bunny.net/css?family=Arimo" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ asset('/css/arimo.css') }}">
    {{-- <link href="https://fonts.cdnfonts.com/css/calibri-light" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ asset('/css/calibri-light.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/source-sans.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/libre-franklin.css') }}">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('/css/fa6.all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/jquery-ui.css') }}">
    <link rel="icon" href="{{ asset('/storage/favicon/favicon.ico') }}" type="image/x-icon">
    {{-- <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script> --}}
    <script src="{{ asset('/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/js/jquery-ui.js') }}"></script>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <!-- Popperjs -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" crossorigin="anonymous"></script> --}}
    <script src="{{ asset('/js/popper.min.js') }}"></script>
    <!-- Tempus Dominus JavaScript -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.4.4/dist/js/tempus-dominus.min.js" crossorigin="anonymous"></script> --}}
    <script src="{{ asset('/js/tempus-dominus.min.js') }}"></script>
    <!-- Tempus Dominus Styles -->
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.4.4/dist/css/tempus-dominus.min.css" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="{{ asset('/css/tempus-dominus.min.css') }}">
    @yield('head')
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg-white position-fixed start-0 end-0 top-0">
            <div class="container-fluid">
                <a class="navbar-brand p-0" href="/">
                    @image([
                    'src' => '/storage/logo/isn_logo.png',
                    'width' => '100px',
                    ])
                    @endimage()
                </a>
            </div>
        </nav>


        @yield('content')
        @switch(true)
            @case(Session::has('status'))
                @alerts([
                'show' => 'show',
                ])
                {{ Session::get('status') }}
                @endalerts
            @break

            @case(Session::has('alert'))
                @alerts([
                'show' => 'show',
                'type' => 'danger',
                ])
                {{ Session::get('alert') }}
                @endalerts
            @break

            @case($errors->any())
                @errors
                @enderrors
            @break

            @default
        @endswitch
    </div>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest"></script>

</body>

</html>
<script type="module">
    $(window).on('load', function() {
        $('#errors').modal('show');
        $('#alert').modal('show');
    });
    $(document).ready(function() {
        $('#main-content').addClass('active');
        $('#sidebar-menu').addClass('active');

        var link = '{{ \Request::url() }}';
        var active_link = $('a[href$="' + link + '"]:first');
        $(active_link).addClass('nav-link-active');
        $(active_link).parents('ul').collapse('show');
    });
</script>
@yield('scripts')
