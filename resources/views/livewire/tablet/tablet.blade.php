<div>
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
                <ul class="navbar-nav mb-2 mb-lg-0" id="myTab" role="tablist">
                    @php
                        $menu_cache_name = Auth::guest() ? 'menu-guest-page-' . request()->path() : 'menu-user-' . Auth::id() . '-' . request()->path();
                    @endphp
                    <!-- tagcache(['menu'], $menu_cache_name, 24 * 3600) cache($menu_cache_name, 24 * 3600) -->
                    <li class="nav-item" role="presentation">
                        <a id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" role="tab"
                            aria-controls="home-tab-pane" aria-selected="true"
                            class="nav-link fs-6 fw-bolder text-uppercase">
                            <x-bs-icon name="person" />&nbsp;Närvaro
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a id="home-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" role="tab"
                            aria-controls="home-tab-pane" aria-selected="true"
                            class="nav-link fs-6 fw-bolder text-uppercase">
                            <x-bs-icon name="calendar" />&nbsp;Bokningar
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a id="home-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" role="tab"
                            aria-controls="home-tab-pane" aria-selected="true"
                            class="nav-link fs-6 fw-bolder text-uppercase">
                            <x-bs-icon name="person" />&nbsp;Contact
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a id="home-tab" data-bs-toggle="tab" data-bs-target="#disabled-tab-pane" role="tab"
                            aria-controls="home-tab-pane" aria-selected="true"
                            class="nav-link fs-6 fw-bolder text-uppercase">
                            <x-bs-icon name="person" />&nbsp;Disabled
                        </a>
                    </li>
                    <!-- endcache -->
                </ul>
            </div>
        </div>
    </nav>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
            tabindex="0">Home</div>
        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
            Profile</div>
        <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
            Contact</div>
        <div class="tab-pane fade" id="disabled-tab-pane" role="tabpanel" aria-labelledby="disabled-tab" tabindex="0">
            disabled</div>
    </div>
</div>
