<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Armagedon') }}</title>
    <link rel="shortcut icon" type="image/jpg" href="{{ asset('images/icon.jpg') }}">

    <!-- Styles -->
    <link href="{{ asset('vendor/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('fullscreen/app.css') }}" rel="stylesheet">

</head>

<body class="font-sans bg-white">
    <div class="container bg-white min-vh-100">
        <!-- Page Content -->
        <main class="px-0 px-sm-1 px-lg-5 py-3">
            {{ $slot ?? '' }}
        </main>
        <!-- Extend page so footer don't hide last content -->
    </div>
</body>

</html>
