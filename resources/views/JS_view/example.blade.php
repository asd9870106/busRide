<script>
// ajax
    
    window.onload = function() {
        
        getBusData();
    }

    function getBusData() {    
        let route = "{{ route('get_bus_station')}}";
        axios({
            url: route,
            method: "get",
        })
        .then(function (response) {
            console.log(response.data);
        })
        .catch(function (error) {
            return;
        })     
    }

    var x = document.getElementById("demo");

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else { 
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showPosition(position) {
        x.innerHTML = "Latitude: " + position.coords.latitude + 
        "<br>Longitude: " + position.coords.longitude;
    }

    // 定義QR碼容器元素.
    var qrcodeContainer = document.getElementById('qrcode');

    // 定義QRCode實例
    var qrcode = new QRCode(qrcodeContainer, {
    text: 'Hello, world!', // QR碼內容
    width: 256, // QR碼寬度
    height: 256, // QR碼高度
    colorDark : '#000000', // QR碼顏色
    colorLight : '#ffffff', // QR碼背景顏色
    correctLevel : QRCode.CorrectLevel.H // QR碼容錯等級
    });

</script>