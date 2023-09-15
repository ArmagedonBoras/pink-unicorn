<nav class="navbar navbar-expand-md navbar-light bg-white border-bottom sticky-top">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand me-4" href="/">
            <img src="{{ asset('images/logo.jpg') }}" style="height: 50px">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"
            aria-controls="#navbar" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbar">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mb-2 mb-lg-0">
                @php
                    $menu_cache_name = Auth::guest() ? 'menu-guest-page-' . request()->path() : 'menu-user-' . Auth::id() . '-' . request()->path();
                @endphp
                <!-- tagcache(['menu'], $menu_cache_name, 24 * 3600) cache($menu_cache_name, 24 * 3600) -->
                    @foreach (menu() as $item)
                        @if ($item->hasChildren())
                            <li class="nav-item dropdown">
                                <a id="{{ $item->link }}MenuDropdown" href="#"
                                    class="{{ Str::startsWith(request()->path(), $item->link) ? 'active ' : '' }}nav-link fs-6 fw-bolder text-uppercase"
                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ $item->name }}&nbsp;<x-icon>caret-down-fill</x-icon>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right animate slideIn"
                                    aria-labelledby="{{ $item->link }}MenuDropdown">
                                    @foreach ($item->getChildren() as $child)
                                        <li><a href="/{{ $item->link }}/{{ $child->link }}"
                                                class="{{ request()->path() == $item->link . '/' . $child->link ? 'active ' : '' }}dropdown-item fs-6 fw-bolder text-uppercase">{{ $child->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                            <li>
                                <a href="{{ Str::startsWith($item->link, 'http') ? $item->link : '/'.$item->link }}"
                                    class="{{ request()->path() == $item->link ? 'active ' : '' }}nav-link fs-6 fw-bolder text-uppercase">{{ $item->name }}</a>
                        @endif
                        </li>
                    @endforeach
                <!-- endcache -->
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav">
                <!-- Settings Dropdown -->
                @auth
                    <li class="nav-item dropdown">
                        <a id="UserDropdown" href="#"
                            class="{{ Str::startsWith(request()->path(), 'users') ? 'active ' : '' }}nav-link fs-6 fw-bolder text-uppercase"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}&nbsp;<x-icon>caret-down-fill</x-icon>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-right animate slideIn" aria-labelledby="UserDropdown">
                            <li><a href="/users/mypage"
                                    class="{{ request()->path() == '/users/mypage' ? 'active ' : '' }}dropdown-item fs-6 fw-bolder text-uppercase">Min
                                    sida</a></li>
                            @foreach (menu('users') as $child)
                                <li><a href="/users/{{ $child->link }}"
                                        class="{{ request()->path() == 'users/' . $child->link ? 'active ' : '' }}dropdown-item fs-6 fw-bolder text-uppercase">{{ $child->name }}</a>
                                </li>
                            @endforeach

                            <!-- Log out -->
                            <hr class="dropdown-divider">
                            <li>
                                <a class="dropdown-item fs-6 fw-bolder text-uppercase" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logga
                                    ut</a>
                            </li>
                            <form method="POST" id="logout-form" action="{{ route('logout') }}">
                                @csrf
                            </form>
                        </ul>
                    </li>
                @else
                    <li>
                        <a href="{{ App::environment() == 'production' ? 'https://medlem.karlstadsbilkooperativ.org' : route('login') }}"
                            class="{{ request()->path() == '/login' ? 'active ' : '' }}nav-link fs-6 fw-bolder text-uppercase">Logga
                            in</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>

</nav>
