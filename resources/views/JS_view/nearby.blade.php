<script>
    // 25.044120321622827, 121.53436126550469
    let LAT;
    let LON;

    window.onload = function() {
        
        init();

    }

    async function init() {
        let userPosition;

        try {
            // 嘗試取得使用者位置
            userPosition = await requestUserPosition();
            console.log('User position is available.');
        } catch (error) {
            // 如果取得位置失敗，顯示提示訊息
            console.log(error.message);
            Swal.fire({
                title: '請提供位置訊息',
                icon: 'warning',
                showCancelButton: false,
                confirmButtonText: '確定',
                }).then((result) => {
                    init();
                })
            console.log('Please allow access to your location.');
            return;
        }
        console.log(userPosition);
        var map0 = new ol.Map({
            target: 'map0',
            layers: [
                new ol.layer.Tile({
                    source: new ol.source.OSM(),
                }),
            ],
            view: new ol.View({
                center: ol.proj.fromLonLat([userPosition.longitude, userPosition.latitude]),
                zoom: 17,
            }),
        });

        var map1 = new ol.Map({
            target: 'map1',
            layers: [
                new ol.layer.Tile({
                    source: new ol.source.OSM(),
                }),
            ],
            view: new ol.View({
                center: ol.proj.fromLonLat([userPosition.longitude, userPosition.latitude]),
                zoom: 17,
            }),
        });
        map0.on('click', clickHandler);
        map1.on('click', clickHandler);

    }

    function requestUserPosition() {
        return new Promise((resolve, reject) => {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(position => {
                const userPosition = {
                    latitude: position.coords.latitude,
                    longitude: position.coords.longitude
                };
                // LAT = position.coords.latitude
                // LON = position.coords.longitude
                console.log(`Latitude: ${userPosition.latitude}, Longitude: ${userPosition.longitude}`);
                resolve(userPosition);
            }, error => {
                reject(error);
            });
            } else {
                reject(new Error('Geolocation is not supported by this browser.'));
            }
        });
    }

    function onSubmit() {
        // 25.080393230869664, 121.3808375018755
        // 25.043932220845907, 121.53437756980118 北科
        LAT = 25.043932220845907;
        LON = 121.53437756980118;
        let distanceInMeters = 200;
        let data = 1;
        let route = "{{ route('get_nearby_station')}}"
        if(data !== ''){
            axios({
                url : route,
                method : "GET",
                params : {
                    'LAT' : LAT,
                    'LON' : LON,
                    'DistanceInMeters' : distanceInMeters,
                }
            })
            .then(function (response) {
                console.log(response.data);
                if(response.data.length === 0){
                    Swal.fire({
                        title: '查無站牌',
                        icon: 'warning',
                        showCancelButton: false,
                        confirmButtonText: '確定',
                    });
                } 
                else {
                    setQrcode(response.data);
                }
            })
            .catch(function (error) {
                if(!error){
                    
                }
            })
        }else {
            Swal.fire({
                    title: '請輸入站牌',
                    icon: 'warning',
                    showCancelButton: false,
                    confirmButtonText: '確定',
                });
        }
    }

    function setQrcode(data) {
        let trComponent;
        let cloneTable = clearTable();
        let table = document.querySelector('.stationQrcode');
        const filteredData = data.filter(item => item.StationAddress);
        data = filteredData;
        console.log(data);
        document.querySelector('.busqrcode').classList.remove('d-none');
        for(let i = 0; i < data.length; i=i+2){
            trComponent = cloneTable.cloneNode(true);
            trComponent.querySelector('.stopName0').textContent = data[i].StationName.Zh_tw;
            trComponent.querySelector('.stopName1').textContent = data[i+1].StationName.Zh_tw;
            trComponent.querySelector('.stopAddress0').textContent = data[i].StationAddress;
            trComponent.querySelector('.stopAddress1').textContent = data[i+1].StationAddress;
            let stationId0 = data[i].StationID;
            let stationId1 = data[i+1].StationID;
            let image0 = trComponent.querySelector('#image0');
            let image1 = trComponent.querySelector('#image1');
            getQrcode(stationId0, image0);
            getQrcode(stationId1, image1);       
            
            table.append(trComponent); 
        }
    }

    function clearTable() {
        let table = document.querySelectorAll('.tr-template');
        let originalTable = table[0];
        for(i=0; i<table.length; i++) {
            table[i].parentNode.removeChild(table[i]);
        }
        return originalTable;
    }

    function getQrcode(stationId, data){
        let qrcode = "http://127.0.0.1:8000/station/?station=" + stationId;
        data.classList.remove('d-none');
        var opts = {
            errorCorrectionLevel: 'H',
            type: 'image/jpeg',
            width: 256,
            height: 256,
            margin: 1,
            color: {
                dark:"#000000",
                light:"#ffffff"
            }
        }

        QRCode.toDataURL(qrcode, opts, function (err, url) {
            if (err) throw err

            data.src = url
        })
    }

    function clickHandler(event) {
        let coordinate = event.coordinate;
        let lonlat = ol.proj.transform(coordinate, 'EPSG:3857', 'EPSG:4326');
        console.log('Longitude: ' + lonlat[0] + ' Latitude: ' + lonlat[1]);
    }

</script>