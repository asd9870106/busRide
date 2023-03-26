<!DOCTYPE html>
<html>
<head>
    @vite(['resources/js/app.js'])
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
</head>
<body>
    <h3>取得憑證資料:</h3>
    <div id="accesstoken" class="align-text-bottom">        
    </div>

    <h3>api 資料:</h3>
    <div id="apireponse" class="align-text-bottom">        
    </div>
    <button id="find-me">Show my location</button><br />
    <p id="status"></p>
    <a id="map-link" target="_blank"></a>

    <div class="visible-print text-center">
        {!! QrCode::size(100)->generate(Request::url()); !!}
        <p>Scan me to return to the original page.</p>
    </div>
    @include('JS_view.example')
</body>
</html>