<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>


    @yield('extra-scripts')
    <style>
        .price-ticker {
            font-size: 150%;
            font-weight: bold;
            margin-top: 5px;
        }

        .red {
            color: red;
        }

        .green {
            color: green;
        }

        .small {
            font-size: 80%;
        }
    </style>
    @yield('extra-styles')
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100">
@include('layouts.navigation')

<!-- Page Heading -->
@yield('header')

<!-- Page Content -->
    <main>
        {{--{{ $slot }}--}}
        @yield('content')
    </main>
</div>
</body>
</html>
