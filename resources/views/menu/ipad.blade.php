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
            <!-- Normal menus -->
            <ul class="navbar-nav mb-2 mb-lg-0">
                @php
                    $menu_cache_name = Auth::guest() ? 'menu-guest-page-' . request()->path() : 'menu-user-' . Auth::id() . '-' . request()->path();
                @endphp
                <!-- tagcache(['menu'], $menu_cache_name, 24 * 3600) cache($menu_cache_name, 24 * 3600) -->
                @foreach (menu('ipad') as $item)
                    @if ($item->hasChildren())
                        <li class="nav-item dropdown">
                            <a id="{{ $item->link }}MenuDropdown" href="#"
                                class="{{ Str::startsWith(request()->path(), $item->link) ? 'active ' : '' }}nav-link fs-6 fw-bolder text-uppercase"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                @if (!empty($item->icon))
                                    <x-icon>{{ $item->icon }}</x-icon>&nbsp;
                                @endif
                                {{ $item->name }}&nbsp;<x-icon>caret-down-fill</x-icon>
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
                                                    <x-icon>{{ $child->icon }}</x-icon>&nbsp;
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
                                    <x-icon>{{ $item->icon }}</x-icon>&nbsp;
                                @endif
                                {{ $item->name }}
                            </a>
                    @endif
                    </li>
                @endforeach
                <!-- endcache -->
            </ul>
        </div>
    </div>

</nav>
