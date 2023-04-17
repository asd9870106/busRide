<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>busServcie</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @vite(['resources/js/app.js'])
    <script src="https://cdn.staticfile.org/qrcodejs/1.0.0/qrcode.min.js"></script>
</head>
@yield('header')
<body>
    {{-- Kai: 前端目前統一使用 Swal 來顯示提示訊息，不使用 flash message --}}
    {{-- @include('layouts._Messages') --}}
       

    <main id="Main_app">
        @yield('contents')
    </main>
    {{-- 尚未打包 js --}}
</body>
</html>
