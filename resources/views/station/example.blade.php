<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://openlayers.org/en/v6.5.0/css/ol.css" type="text/css">
    <script src="https://openlayers.org/en/v6.5.0/build/ol.js"></script>
    @vite(['resources/js/app.js'])
</head>
<body>
    {{-- <h3>取得憑證資料:</h3>
    <div id="accesstoken" class="align-text-bottom">        
    </div>

    <h3>api 資料:</h3>
    <div id="apireponse" class="align-text-bottom">        
    </div> --}}
    {{-- <button id="find-me">Show my location</button><br />
    <p id="status"></p>
    <a id="map-link" target="_blank"></a> --}}

    {{-- <p>Click the button to get your coordinates.</p>

    <button onclick="getLocation()">Try It</button>

    <p id="demo"></p>

    <div class="visible-print text-center">
        {!! QrCode::size(100)->generate(Request::url()); !!}
        <p>Scan me to return to the original page.</p>
    </div>
    <script src="https://cdn.staticfile.org/qrcodejs/1.0.0/qrcode.min.js"></script>
    <div class="m-3" id="qrcode"></div> --}}

    <div id="map" style="width: 100%; height: 500px;"></div>
    <input id="addressInput" type="text" placeholder="输入地址">
    <button onclick="searchAddress()">搜索</button>
    
    @include('JS_view.example')
</body>
</html>