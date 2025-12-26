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
    <link rel="dns-prefetch" nonce="{{ csp_nonce() }}" href="//fonts.gstatic.com">
    <link rel="stylesheet" nonce="{{ csp_nonce() }}" href="{{ asset('/css/nunito.css') }}">
    <link rel="stylesheet" nonce="{{ csp_nonce() }}" href="{{ asset('/css/arimo.css') }}">
    <link rel="stylesheet" nonce="{{ csp_nonce() }}" href="{{ asset('/css/calibri-light.css') }}">
    <link rel="stylesheet" nonce="{{ csp_nonce() }}" href="{{ asset('/css/source-sans.css') }}">
    <link rel="stylesheet" nonce="{{ csp_nonce() }}" href="{{ asset('/css/libre-franklin.css') }}">
    <!-- Styles -->
    <link rel="stylesheet" nonce="{{ csp_nonce() }}" href="{{ asset('/css/fa6.all.min.css') }}">
    <link rel="stylesheet" nonce="{{ csp_nonce() }}" href="{{ asset('/css/jquery-ui.css') }}">
    <link rel="icon" nonce="{{ csp_nonce() }}" href="{{ asset('/storage/favicon/favicon.png') }}"
        type="image/x-icon">
    <script nonce="{{ csp_nonce() }}" src="{{ asset('/js/jquery.min.js') }}"></script>
    <script nonce="{{ csp_nonce() }}" src="{{ asset('/js/jquery-ui.min.js') }}"></script>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <!-- Popperjs -->
    <script nonce="{{ csp_nonce() }}" src="{{ asset('/js/popper.min.js') }}"></script>
    <!-- Tempus Dominus JavaScript -->
    <script nonce="{{ csp_nonce() }}" src="{{ asset('/js/tempus-dominus.min.js') }}"></script>
    <!-- Tempus Dominus Styles -->
    <link rel="stylesheet" nonce="{{ csp_nonce() }}" href="{{ asset('/css/tempus-dominus.min.css') }}">
    {{-- <script src="{{ asset('js/logout.js') }}" nonce="{{ csp_nonce() }}"></script> --}}

    @yield('head')
</head>

<body>
    <div id="app" class="app-frontend">
        <main class="py-4">

            <div id="main-content">

                @include('layouts.main-navigation')

                @if (Request::is('promotions'))
                    @include('layouts.banner')
                @endif

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
        </main>
    </div>

    <script nonce="{{ csp_nonce() }}" src="https://unpkg.com/@lottiefiles/lottie-player@latest"></script>
</body>

</html>
<script type="module" nonce="{{ csp_nonce() }}">
    $(window).on('load', function() {
        $('#errors').modal('show');
        $('#alert').modal('show');
    });
    $(document).ready(function() {
        if (window.innerWidth > 8000) {
            $('#main-content').addClass('active-main-content');
            $('#sidebar-menu').addClass('active-sidebar-menu');
        } else {
            $('#main-content').removeClass('active-main-content');
            $('#sidebar-menu').removeClass('active-sidebar-menu');
        }

        var link = '{{ \Request::url() }}';
        var active_link = $('a[href$="' + link + '"]:first');
        $(active_link).addClass('nav-link-active');
        $(active_link).parents('ul').collapse('show');
    });
</script>
<script type="module" nonce="{{ csp_nonce() }}">
    document.addEventListener('DOMContentLoaded', () => {
        const logoutLink = document.getElementById('logout-link');
        if (logoutLink) {
            logoutLink.addEventListener('click', function(e) {
                e.preventDefault();
                document.getElementById('logout-form').submit();
            });
        }
    });
</script>
@yield('scripts')
