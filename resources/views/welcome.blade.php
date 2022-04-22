<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <link rel="prefetch" href="https://fonts.googleapis.com/css?family=Nunito">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
    <main>
        <h1>Welcome page!</h1>
    </main>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>