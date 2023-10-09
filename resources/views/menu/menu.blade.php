<nav class="navbar navbar-expand-md navbar-light bg-white border-bottom sticky-top">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand me-4" href="/">
            <img src="{{ asset('images/armagedon-liggande.svg') }}" type="image/svg+xml" style="height: 50px">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"
            aria-controls="#navbar" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbar">
            <!-- Normal menus -->
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
                                @if (!empty($item->icon))
                                    <x-bs-icon :name="$item->icon" />&nbsp;
                                @endif
                                {{ $item->name }}&nbsp;<x-bs-icon name="caret-down-fill" />
                            </a>

                            <ul class="dropdown-menu dropdown-menu-right animate slideIn"
                                aria-labelledby="{{ $item->link }}MenuDropdown">
                                @foreach ($item->getChildren() as $child)
                                    @if ($child->divider)
                                        <hr class="dropdown-divider">
                                    @else
                                        <li><a href="/{{ $item->link }}/{{ $child->link }}"
                                                class="{{ request()->path() == $child->link . '/' . $child->link ? 'active ' : '' }}dropdown-item fs-6 fw-bolder text-uppercase">
                                                @if (!empty($child->icon))
                                                    <x-bs-icon :name="$child->icon" />&nbsp;
                                                @endif
                                                {{ $child->name }}
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        @else
                        <li>
                            <a href="{{ Str::startsWith($item->link, 'http') ? $item->link : '/' . $item->link }}"
                                class="{{ request()->path() == $item->link ? 'active ' : '' }}nav-link fs-6 fw-bolder text-uppercase">
                                @if (!empty($item->icon))
                                    <x-bs-icon :name="$item->icon" />&nbsp;
                                @endif
                                {{ $item->name }}
                            </a>
                    @endif
                    </li>
                @endforeach
                <!-- endcache -->
            </ul>

            <!-- User menu -->
            <ul class="navbar-nav">
                @auth
                    <li class="nav-item dropdown">
                        <a id="UserDropdown" href="#"
                            class="{{ Str::startsWith(request()->path(), 'anvandare') ? 'active ' : '' }}nav-link fs-6 fw-bolder text-uppercase"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <x-bs-icon name="person" />&nbsp;{{ Auth::user()->name }}&nbsp;<x-bs-icon
                                name="caret-down-fill" />
                        </a>

                        <ul class="dropdown-menu dropdown-menu-right animate slideIn" aria-labelledby="UserDropdown">
                            <li><a href="/anvandare/minsida"
                                    class="{{ request()->path() == 'anvandare/minsida' ? 'active ' : '' }}dropdown-item fs-6 fw-bolder text-uppercase">
                                    <x-bs-icon name="person-badge" />&nbsp;Min sida
                                </a>
                            </li>
                            @foreach (menu('users') as $child)
                                @if ($child->divider)
                                    <hr class="dropdown-divider">
                                @else
                                    <li><a href="/anvandare/{{ $child->link }}"
                                            class="{{ request()->path() == 'anvandare/' . $child->link ? 'active ' : '' }}dropdown-item fs-6 fw-bolder text-uppercase">
                                            @if (!empty($child->icon))
                                                <x-bs-icon :name="$child->icon" />&nbsp;
                                            @endif
                                            {{ $child->name }}
                                        </a>
                                    </li>
                                @endif
                            @endforeach

                            <!-- Log out -->
                            <hr class="dropdown-divider">
                            <li>
                                <a class="dropdown-item fs-6 fw-bolder text-uppercase" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <x-bs-icon name="door-closed-fill" />&nbsp;Logga ut
                                </a>
                            </li>
                            <form method="POST" id="logout-form" action="{{ route('logout') }}">
                                @csrf
                            </form>
                        </ul>
                    </li>
                @else
                    <li>
                        <a href="{{ route('login') }}"
                            class="{{ request()->path() == 'login' ? 'active ' : '' }}nav-link fs-6 fw-bolder text-uppercase"><x-bs-icon
                                name="door-open" />&nbsp;Logga in</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>

</nav>
