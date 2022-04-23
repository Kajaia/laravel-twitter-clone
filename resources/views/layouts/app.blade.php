<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <!-- Styles -->
    <link rel="prefetch" href="https://fonts.googleapis.com/css?family=Nunito">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @yield('styles')
    @livewireStyles
</head>
<body class="d-flex flex-column min-vh-100 bg-gray">
    <x-the-navbar />
    <!-- Main content -->
    <main class="container my-4">
        @yield('content')
    </main>
    <!-- /Main content -->
    <!-- Scripts -->
    <script src="https://kit.fontawesome.com/ac59870ee9.js" crossorigin="anonymous"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    @yield('scripts')
    @livewireScripts
</body>
</html>