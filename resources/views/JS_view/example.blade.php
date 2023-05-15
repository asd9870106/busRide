<script>
// ajax
    
    // window.onload = function() {
        
    //     getBusData();
    // }

    // function getBusData() {    
    //     let route = "{{ route('get_taipei_stop')}}";
    //     axios({
    //         url: route,
    //         method: "get",
    //     })
    //     .then(function (response) {
    //         console.log(response.data);
    //     })
    //     .catch(function (error) {
    //         return;
    //     })     
    // }

    // var x = document.getElementById("demo");

    // function getLocation() {
    //     if (navigator.geolocation) {
    //         navigator.geolocation.getCurrentPosition(showPosition);
    //     } else { 
    //         x.innerHTML = "Geolocation is not supported by this browser.";
    //     }
    // }

    // function showPosition(position) {
    //     x.innerHTML = "Latitude: " + position.coords.latitude + 
    //     "<br>Longitude: " + position.coords.longitude;
    // }

    // // 定義QR碼容器元素.
    // var qrcodeContainer = document.getElementById('qrcode');

    // // 定義QRCode實例
    // var qrcode = new QRCode(qrcodeContainer, {
    // text: 'Hello, world!', // QR碼內容
    // width: 256, // QR碼寬度
    // height: 256, // QR碼高度
    // colorDark : '#000000', // QR碼顏色
    // colorLight : '#ffffff', // QR碼背景顏色
    // correctLevel : QRCode.CorrectLevel.H // QR碼容錯等級
    // });
    var map = new ol.Map({
            target: 'map',
            layers: [
                new ol.layer.Tile({
                    source: new ol.source.OSM()
                })
            ],
            view: new ol.View({
                center: ol.proj.fromLonLat([0, 0]),
                zoom: 2
            })
        });

        function searchAddress() {
            var address = document.getElementById('addressInput').value;
            if (address !== '') {
                var url = 'https://nominatim.openstreetmap.org/search?format=json&q=' + encodeURIComponent(address);

                axios.get(url)
                    .then(function (response) {
                        var data = response.data;
                        console.log(data);
                        if (data.length > 0) {
                            var result = data[0];
                            var coordinate = [parseFloat(result.lon), parseFloat(result.lat)];

                            map.getView().animate({ center: ol.proj.fromLonLat(coordinate), zoom: 14 });
                            
                            var marker = new ol.Feature({
                                geometry: new ol.geom.Point(ol.proj.fromLonLat(coordinate))
                            });

                            var vectorSource = new ol.source.Vector({
                                features: [marker]
                            });

                            var markerVectorLayer = new ol.layer.Vector({
                                source: vectorSource
                            });

                            map.addLayer(markerVectorLayer);
                        } else {
                            alert('找不到該地址');
                        }
                    })
                    .catch(function (error) {
                        alert('地址解析錯誤');
                    });
            } else {
                alert('請輸入地址');
            }
        }

</script>