<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <!-- Styles -->

    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>

</head>
<body>

    @yield('content')

    <script type="text/javascript" src="{{url('js/main.js')}}"></script>
</body>
</html>
