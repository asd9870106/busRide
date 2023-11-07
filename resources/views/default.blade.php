<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>busServcie</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @vite(['resources/js/app.js'])

    <script src="https://cdn.jsdelivr.net/npm/ol@v7.3.0/dist/ol.js"></script>

</head>
@yield('header')
<body>

    <main id="Main_app">
        @yield('contents')
    </main>
</body>
</html>
