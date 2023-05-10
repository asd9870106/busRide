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
            userLat = 25.042938157385166;
            userLon = 121.5357200537496;
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
        var zoomsliderControl= new ol.control.ZoomSlider();
        map.addControl(zoomsliderControl);
        var scaleLineControl = new ol.control.ScaleLine({
            units: "metric"
        });
        map.addControl(scaleLineControl);
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
        userLat = 25.042938157385166;
        userLon = 121.5357200537496;

        let userPosition = await getNearbyStation(userLat, userLon);
        // let userStation = checkStation(userPosition);
        // console.log(userPosition);
        // setQrcode(userPosition);
        if(destinationLat !== undefined || destinationLon !== undefined){
            let planRoute = await getPlanRoute(userLat, userLon, destinationLat, destinationLon)
            // console.log(planRoute);
            setQrcode(planRoute.data.routes);
            // let destinationPosition = await getNearbyStation(destinationLat, destinationLon);
            // let data = userPosition.concat(destinationPosition)
            // setQrcode(data);
            // let station = checkStation(userPosition, destinationPosition);
        }
    }

    async function getPlanRoute(userLat, userLon, desLat, desLon){
        let data;
        let route = "{{ route('get_plan_route')}}"
        await axios({
            url : route,
            method : "GET",
            params : {
                'UserLat' : userLat,
                'UserLon' : userLon,
                'DesLat' : desLat,
                'DesLon' : desLon,
            }
        })
        .then(function (response) {
            console.log(response);
            data = response.data;

        })
        .catch(function (error) {
            return;
        })
        return data;
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

    async function setQrcode(data) {
        console.log(data);
        let trComponent;
        let cloneTable = clearTable();
        let table = document.querySelector('.stationQrcode');
        document.querySelector('.busqrcode').classList.remove('d-none');
        for(let i=0; i<data.length; i++){
            // 不用轉乘
            if(data[i].transfers === 0){
                let section = data[i].sections;
                for(let j = 0; j < section.length; j++){
                    // 搭交通工具
                    if(section[j].type === "transit"){
                        if(section[j].transport.category === "Bus") {
                            trComponent = cloneTable.cloneNode(true);
                            let stationID = await getStationID(section[j].departure.place.name);
                            let l = data[i].transfers;
                            trComponent.classList.remove('tr-template');
                            trComponent.classList.remove('d-none');
                            trComponent.querySelector('#embark').classList.remove('d-none');
                            trComponent.querySelector('#route').classList.remove('d-none');
                            trComponent.querySelector('#qrcode').classList.remove('d-none');
                            trComponent.querySelector('#image0').classList.remove('d-none');
                            trComponent.querySelector('#dash').classList.remove('d-none');
                            // 轉乘次數
                            trComponent.querySelector('#transfers').textContent = data[i].transfers;
                            // 出發站
                            trComponent.querySelector('#departure').textContent = l+1 + ". " +  section[j].departure.place.name;
                            // 目的地
                            trComponent.querySelector('#arrival').textContent = section[j].arrival.place.name;
                            // 路線
                            trComponent.querySelector('#route').textContent = section[j].transport.name;
                            // qrcode
                            trComponent.querySelector('#qrcodeName').textContent = section[j].departure.place.name;
                            // 票價
                            trComponent.querySelector('#price').textContent = data[i].total_price + " 元";
                            
                            let stationId = stationID[0].station_id;
                            let image = trComponent.querySelector('#image0');
                            trComponent.querySelector('#qrcode');
                            getQrcode(stationId, image);
                            table.append(trComponent); 
                        }
                    }
                }
            } else {
                let section = data[i].sections;
                trComponent = cloneTable.cloneNode(true);
                trComponent.classList.remove('tr-template');
                trComponent.classList.remove('d-none');
                let l = 0;
                let category = true;
                for(let j = 0; j < section.length; j++){
                    // 搭交通工具
                    if(section[j].type === "transit"){
                        if(section[j].transport.category === "HighwayBus") {
                            category = false;
                        }
                        if(section[j].transport.category === "Bus") {
                            l = l+1;
                            let stationID = await getStationID(section[j].departure.place.name);
                            let embark = trComponent.querySelector('#embark').cloneNode(true);
                            let route = trComponent.querySelector('#route').cloneNode(true);
                            let qrcode = trComponent.querySelector('#qrcode').cloneNode(true);
                            // 出發站
                            embark.classList.remove('d-none');
                            embark.querySelector('#departure').textContent = l + ". " +  section[j].departure.place.name;
                            embark.querySelector('#dash').classList.remove('d-none');
                            // 目的地
                            embark.querySelector('#arrival').textContent = section[j].arrival.place.name;
                            // 路線
                            route.classList.remove('d-none');
                            route.textContent = l + ". " + section[j].transport.name;
                            // qrcode
                            qrcode.classList.remove('d-none');
                            qrcode.querySelector('#image0').classList.remove('d-none');
                            qrcode.querySelector('#qrcodeName').textContent = section[j].departure.place.name;
                            
                            trComponent.querySelector('.embark').append(embark);
                            trComponent.querySelector('.route').append(route);
                            trComponent.querySelector('.qrcode').append(qrcode);

                            let stationId = stationID[0].station_id;
                            let image = qrcode.querySelector('#image0');
                            getQrcode(stationId, image);
                        }
                    }
                }
                // 轉乘次數
                trComponent.querySelector('#transfers').textContent = data[i].transfers;
                // 票價
                trComponent.querySelector('#price').textContent = data[i].total_price + " 元";
                if(category){
                    table.append(trComponent); 
                }
            }
        }
        // const filteredData = data.filter(item => item.StationAddress);
        // data = filteredData;
        // document.querySelector('.busqrcode').classList.remove('d-none');
        // for(let i = 0; i < data.length; i++){
        //     trComponent = cloneTable.cloneNode(true);
        //     trComponent.querySelector('#stopName').textContent = "站牌 : " + data[i].StationName.Zh_tw;
        //     trComponent.querySelector('#stopName1').textContent = "站牌 : " + data[i].StationName.Zh_tw;
        //     trComponent.querySelector('#stopAddress').textContent = "地址 : " + data[i].StationAddress;
        //     trComponent.querySelector('#stopAddress1').textContent = "地址 : " + data[i].StationAddress;
        //     trComponent.querySelector('.stopAddress0').textContent = data[i].StationAddress;
        //     let stationId0 = data[i].StationID;
        //     let image0 = trComponent.querySelector('#image0');
        //     getQrcode(stationId0, image0);
        //     table.append(trComponent); 
        // }
    }

    async function getStationID(stationName) {
        let data;
        let route = "{{ route('get_stationid') }}"
            await axios({
                url : route,
                method : "GET",
                params : {
                    'station' : stationName
                }
            })
            .then(function (response) {
                data = response.data;
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
                if(!error){
                    
                }
            })
        return data;
    }

    function clearTable() {
        let table = document.querySelector('.tr-template');
        let tbody = document.querySelector('.stationQrcode');
        let originalTable = document.querySelectorAll('.stationQrcode tr');
        if(originalTable.length !== 0){
            for(let i = 0; i < originalTable.length; i++) {
                tbody.removeChild(originalTable[i]);
            }
        }
        return table;
    }

    function getQrcode(stationId, data){
        let qrcode = "http://127.0.0.1:8000/station/?station=" + stationId;
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