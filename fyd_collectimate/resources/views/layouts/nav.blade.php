<nav id="sidebar-menu" class="sidebar shadow">
    <div class="sidebar-header">
    </div>
    <div class="px-2">
        <div class="text-center">
            <a href={{ route('home') }} class="d-flex align-items-center justify-content-center mb-3 nav-link-active">
                <img class="text-center nav-logo" src="{{ asset('/storage/logo/logo.png') }}">
            </a>
        </div>
    </div>
    <ul class="nav flex-column " id="nav_accordion">
        <!-- Authentication Links -->
        <ul class="list-unstyled p-0 components fl-nav custom-scrollbar">
            <ul class="nav flex-column ">
                @auth
                    <ul class="nav flex-column " id="nav_accordion">
                        @foreach ($instructions as $instruction)
                            @if ($instruction['dom'] == 'ul')
                                @if (array_key_exists('class', $instruction) && $instruction['class'] == 'first')
                                    <ul class="nav flex-column ">
                                    @else
                                        <ul class="submenu  collapse">
                                @endif
                            @elseif ($instruction['dom'] == 'li')
                                @if (array_key_exists('class', $instruction))
                                    <li class="nav-item has-submenu "><a class="nav-link font-awesome-icons is_accordion"
                                            href="#">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span>{{ $instruction['menu_name'] }}</span><i
                                                    class="fa-solid fa-chevron-down arrow-down-hover nav-fs-10p"></i>
                                            </div>
                                        </a>
                                    @else
                                        @switch(true)
                                            @case(str_contains($instruction['url'], '.') && Route::has($instruction['url']))
                                            <li class="nav-item"><a class="nav-link"
                                                    href="{{ route($instruction['url']) }}">{{ $instruction['menu_name'] }}</a>
                                            @break

                                            @case(!str_contains($instruction['url'], '.') && Route::has($instruction['url'] . '.index'))
                                            <li class="nav-item"><a class="nav-link"
                                                    href="{{ route($instruction['url'] . '.index') }}">{{ $instruction['menu_name'] }}</a>
                                            @break

                                            @default
                                                @if (Route::has($instruction['url']))
                                            <li class="nav-item"><a class="nav-link"
                                                    href="{{ route($instruction['url']) }}">{{ $instruction['menu_name'] }}</a>
                                        @endif
                                    @break
                                @endswitch
                                {{-- <li class="nav-item"><a class="nav-link" href="{{ isset($instruction['url']) ? route($instruction['url'].'.index'):'#' }}">{{ $instruction['menu_name'] }}</a> --}}
                            @endif
                        @elseif ($instruction['dom'] == '/li')
                            </li>
                        @elseif ($instruction['dom'] == '/ul')
                    </ul>
                @else
                    <div>unsupported tag</div>
                    @endif
                    @endforeach
                </ul>
            @endauth
            @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif
                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('registers.create') }}">{{ __('Register') }}</a>
                </li> --}}
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item has-submenu mb-5 pb-5"><a class="nav-link font-awesome-icons is_accordion"
                        href="#">
                        <div class="d-flex align-items-center justify-content-between">{{ Auth::user()->name }}</span><i
                                class="fa-solid fa-chevron-down arrow-down-hover nav-fs-10p"></i></div>
                    </a>
                    <ul class="submenu collapse ">
                        <li class="nav-item"><a class="nav-link"
                                href="{{ route('users.profile-show', ['user' => Auth::id()]) }}">Account Profile</a></li>
                        <li class="nav-item"><a class="nav-link"
                                href="{{ route('users.profile-edit-password', ['user' => Auth::id()]) }}">Change
                                Password</a></li>
                        <li class="nav-item">
                            {{-- <a class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}</a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form> --}}


                            <a class="nav-link" id="logout-link" href="{{ route('logout') }}">Logout</a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>

                            <script src="{{ asset('js/app.js') }}" nonce="{{ csp_nonce() }}"></script>

                    </ul>
                </li>
            @endguest
        </ul>
    </ul>
    </ul>

</nav>
