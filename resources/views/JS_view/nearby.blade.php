<script>
    // 25.044120321622827, 121.53436126550469

    let userLat;
    let userLon;
    let destinationLat;
    let destinationLon;
    let map;

    window.onload = function() {
        
        init();

    }

    async function init() {
        let userPosition;

        try {
            // 嘗試取得使用者位置
            userPosition = await requestUserPosition();
            // userLat = userPosition.latitude;
            // userLon = userPosition.longitude;
            // 北科位置
            userLat = 25.04390473817004;
            userLon = 121.53442041114596;
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
        const userLocation = ol.proj.fromLonLat([userLon, userLat]);
        // const userLocation = ol.proj.fromLonLat([userPosition.longitude, userPosition.latitude]);
        map = new ol.Map({
            target: 'map',
            layers: [
                new ol.layer.Tile({
                    source: new ol.source.OSM(),
                }),
            ],
            view: new ol.View({
                center: userLocation,
                zoom: 17,
            }),
        });
        
        const marker = new ol.Feature({
            geometry: new ol.geom.Point(userLocation)
        });

        const markerLayer = new ol.layer.Vector({
            source: new ol.source.Vector({
                features: [marker]
            }),
            style: new ol.style.Style({
                image: new ol.style.Circle({
                    radius: 6,
                    fill: new ol.style.Fill({
                        color: "blue"
                    }),
                    stroke: new ol.style.Stroke({
                        color: "white",
                        width: 2
                    })
                })
            })
        });
        map.addLayer(markerLayer);
        
        // 25.043932220845907, 121.53437756980118 北科

        
        map.on('click', clickHandler);
        map.on("click", handleMapClick);

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

    async function onSubmit() {
        // 25.080393230869664, 121.3808375018755
        // 25.043932220845907, 121.53437756980118 北科
        userLat = 25.043932220845907;
        userLon = 121.53437756980118;

        let userPosition = await getNearbyStation(userLat, userLon);
        // let userStation = checkStation(userPosition);
        // console.log(userPosition);
        setQrcode(userPosition);
        if(destinationLat !== undefined || destinationLon !== undefined){
            let destinationPosition = await getNearbyStation(destinationLat, destinationLon);
            let data = userPosition.concat(destinationPosition)
            setQrcode(data);
            // let station = checkStation(userPosition, destinationPosition);
        }
    }

    async function getNearbyStation(lat, lon){
        let data;
        let route = "{{ route('get_nearby_station')}}"
        let distanceInMeters = 250;
        await axios({
            url : route,
            method : "GET",
            params : {
                'LAT' : lat,
                'LON' : lon,
                'DistanceInMeters' : distanceInMeters,
            }
        })
        .then(function (response) {
            data = response.data;
            console.log(response.data);
            if(response.data.length === 0){
                Swal.fire({
                    title: '查無站牌',
                    icon: 'warning',
                    showCancelButton: false,
                    confirmButtonText: '確定',
                });
            } 

        })
        .catch(function (error) {
            return;
        })
        return data;
    }

    // async function checkStation(data0, data1) {
    //     let userStationBus = [];
    //     let desStationBus = [];
    //     const filteredData0 = data0.filter(item => item.StationAddress);
    //     const filteredData1 = data1.filter(item => item.StationAddress);
    //     for(let i = 0; i < filteredData0.length; i++) {
    //         userStationBus[i] = await getStationBus(filteredData0[i].StationID);
    //     }
    //     for(let j = 0; j < filteredData1.length; j++) {
    //         desStationBus[j] = await getStationBus(filteredData1[j].StationID);
    //     }   
    //     for(let k = 0; k < userStationBus.length; k++){
    //         for(let l = 0; l < desStationBus.length; l++){
    //             for(let m = 0; m< userStationBus[k].length; m++) {
    //                 for(let n=0; n <desStationBus[l].length; n++){
    //                     if(userStationBus[k][m].StopID === desStationBus[l][n].StopID){
    //                         console.log('nice');
    //                     }
    //                 }
    //             }

    //         }
    //     }

    //     console.log(userStationBus);
    //     console.log(desStationBus);
    // }
    
    async function getStationBus(stationID){
        let route = "{{ route('get_taipei_stop')}}";
        let data = '';
        await axios({
            url: route,
            method: "get",
            params: {
                'stationId' : stationID
            }
        })
        .then(function (response) {
            // console.log(response.data);
            data = response.data;
        })
        .catch(function (error) {
        })     
        return data;
    }

    function setQrcode(data) {
        let trComponent;
        let cloneTable = clearTable();
        let table = document.querySelector('.stationQrcode');
        const filteredData = data.filter(item => item.StationAddress);
        data = filteredData;
        document.querySelector('.busqrcode').classList.remove('d-none');
        for(let i = 0; i < data.length; i++){
            trComponent = cloneTable.cloneNode(true);
            trComponent.querySelector('#stopName').textContent = "站牌 : " + data[i].StationName.Zh_tw;
            trComponent.querySelector('#stopName1').textContent = "站牌 : " + data[i].StationName.Zh_tw;
            trComponent.querySelector('#stopAddress').textContent = "地址 : " + data[i].StationAddress;
            trComponent.querySelector('#stopAddress1').textContent = "地址 : " + data[i].StationAddress;
            trComponent.querySelector('.stopAddress0').textContent = data[i].StationAddress;
            let stationId0 = data[i].StationID;
            let image0 = trComponent.querySelector('#image0');
            getQrcode(stationId0, image0);
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
        destinationLon = lonlat[0];
        destinationLat = lonlat[1];
        console.log('Longitude: ' + lonlat[0] + ' Latitude: ' + lonlat[1]);
    }

    function handleMapClick(event) {
        const markerLayers = map.getLayers().getArray().filter(layer => {
            return layer.get('name') === 'markerLayer';
        });
        if (markerLayers.length > 0) {
            map.removeLayer(markerLayers[0]);
        }
        const clickedLocation = event.coordinate;

        // Add a marker at the clicked location
        const marker = new ol.Feature({
            geometry: new ol.geom.Point(clickedLocation)
        });
        const markerLayer = new ol.layer.Vector({
            source: new ol.source.Vector({
                features: [marker]
            }),
            style: new ol.style.Style({
                image: new ol.style.Circle({
                    radius: 6,
                    fill: new ol.style.Fill({
                        color: "red"
                    }),
                    stroke: new ol.style.Stroke({
                        color: "white",
                        width: 2
                    })
                })
            }),
            name: 'markerLayer'
        });
        map.addLayer(markerLayer);
    }
    
</script>