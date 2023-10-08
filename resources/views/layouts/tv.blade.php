<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Armagedon') }}</title>
    <link rel="shortcut icon" type="image/jpg" href="{{ asset('images/icon.jpg') }}">

    <!-- Styles -->
    <link href="{{ asset('vendor/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('tv.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('vendor/moment/moment-with-locales.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('tv.js') }}" defer></script>
</head>

<body class="bg-white">
    {{ $slot ?? '' }}
</body>

</html>
