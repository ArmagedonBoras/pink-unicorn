<div>
    <div class="row p-0 sticky-top">
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
                        @foreach (menu('tablet') as $child)
                            <li><a href="/tablet/{{ $child->link }}"
                                    class="{{ request()->path() == 'tablet/' . $child->link ? 'active ' : '' }}nav-link fs-6 fw-bolder text-uppercase">
                                    @if (!empty($child->icon))
                                        <x-bs-icon :name="$child->icon" />&nbsp;
                                    @endif
                                    {{ $child->name }}
                                </a>
                            </li>
                        @endforeach
                        <!-- endcache -->
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <main class="px-0 px-sm-1 px-lg-5 py-3">
        Main page
    </main>
</div>
