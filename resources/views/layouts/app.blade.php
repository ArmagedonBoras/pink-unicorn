<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Armagedon') }}</title>
    <link rel="shortcut icon" type="image/svg+xml" href="{{ asset('images/armagedon-icon.svg') }}">

    <!-- Styles -->
    <link href="{{ asset('vendor/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/flatpickr/flatpickr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/summernote/summernote-bs5.min.css') }}" rel="stylesheet">
    <link href="{{ asset('app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('vendor/moment/moment-with-locales.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <!-- script src="{{ asset('vendor/alpine/alpine.js') }}" defer></script -->
    <script src="{{ asset('vendor/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('vendor/flatpickr/sv.js') }}"></script>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/summernote/summernote-bs5.min.js') }}"></script>
    <script src="{{ asset('vendor/sort.js') }}"></script>
    <script src="{{ asset('app.js') }}" defer></script>
</head>

<body class="font-sans antialiased bg-light">
    <div class="container bg-white min-vh-100">
        <div class="row p-0 sticky-top">
            @include('menu.menu')
            <span class="d-flex justify-content-center bg-white">@include('cookie-consent::index')</span>
            @env(['staging', 'local'])
            <span class="d-flex justify-content-center bg-danger text-white p-2">
                Testversion. Ändringar kommer att skrivas över oregelbundet.
            </span>
            @endenv
        </div>
        <!--x-jet-banner /-->


        <!-- Page Heading -->
        <header class="row p-0 bg-white">
            <div class="hero-image"
                style="background-image: url('{{ asset($image ?? '') }}'); height: {{ $size ?? 150 }}px;">
                <div class="hero-text">
                    <h1 style="font-size:50px{{ !empty($title_color) ? ';color:' . $title_color : '' }}">
                        {{ $title ?? '' }}
                    </h1>
                    <h3 style="{{ !empty($tagline_color) ? 'color:' . $tagline_color . ';' : '' }}">
                        {{ $tagline ?? '' }}
                    </h3>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="px-0 px-sm-1 px-lg-5 py-3">
            {{ $slot ?? '' }}
        </main>
        <!-- Extend page so footer don't hide last content -->
        <div class="row p-3">&nbsp;</div>
    </div>

    @stack('modals')
    @stack('scripts')

    <footer class="container p-3 bg-dark text-white fixed-bottom">
        <div class="row justify-content-center ">
            &copy; 1982 - {{ now()->year }} Armagedon
        </div>
    </footer>
</body>

</html>
