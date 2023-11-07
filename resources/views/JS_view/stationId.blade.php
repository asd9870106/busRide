<script>
    
    let url = new URLSearchParams(window.location.search);
    const station = url.get('station');
    console.log(station);

    let countdown = 15;
    let timer = setInterval(updateTimer, 1000);

    let userPosition;
    window.onload = function() {
        
        init();

    }


    async function init() {
        // checkStop();
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
        let taipeiStops = await getTaipeiStop();
        let newTaipeiStops = await getNewTaipeiStop();
        setBusStatus(taipeiStops, newTaipeiStops);
        setBusData(taipeiStops, newTaipeiStops);
        // 在這裡繼續執行其他操作
    }

    function requestUserPosition() {
        return new Promise((resolve, reject) => {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(position => {
                const userPosition = {
                    latitude: position.coords.latitude,
                    longitude: position.coords.longitude
                };
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

    async function getStationData() {
        let route = "{{ route('get_stationid')}}";
        let busName = document.querySelector('#bus_name').textContent
        let data = '';
        await axios({
            url : route,
            method : "GET",
            params : {
                'station' : busName
            }
        })
        .then(function (response) {
            console.log(response.data);
            data = response.data;
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
        return data;
    }

    function checkStop() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(checkPosition);
        } else {
            Swal.fire({
                title: '請到公車站牌附近',
                icon: 'warning',
                showCancelButton: false,
                confirmButtonText: '確定',
                })
        }
    }

    async function checkPosition(position) {
        let stationData = await getStationData();
        let stopLat;
        let stopLon;
        for(let i = 0; i < stationData.length; i++){
            if(station == stationData[i].station_id){
                stopLat = stationData[i].position_lat;
                stopLon = stationData[i].position_lon;
            }
        }
        // let latitude2 = 25.08002;
        // let longitude2 = 121.38110;
        // let latitude2 = 25.080277;
        // let longitude2 = 121.378887;
        let userLat = position.coords.latitude; 
        let userLon = position.coords.longitude;
        let distance = getDistanceFromLatLonInM(stopLat, stopLon, userLat, userLon);
        console.log(distance);
        if(distance >= 15) {
            userPosition = true;
        } else {
            Swal.fire({
                title: '請到公車站牌附近',
                icon: 'warning',
                showCancelButton: false,
                confirmButtonText: '確定',
                }).then((result) => {
                    userPosition = false;
                })
        }
    }

    function getDistanceFromLatLonInM(lat1, lon1, lat2, lon2) {
        const R = 6371e3; // 地球的半徑 meters
        const dLat = deg2rad(lat2 - lat1);
        const dLon = deg2rad(lon2 - lon1);
        const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                    Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
                    Math.sin(dLon / 2) * Math.sin(dLon / 2);
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        const d = R * c; // 距離 meter
        return d;
    }

    function deg2rad(deg) {
        return deg * (Math.PI/180);
    }


    async function getTaipeiStop() {    
        let route = "{{ route('get_taipei_stop')}}";
        let data = '';
        await axios({
            url: route,
            method: "get",
            params: {
                'stationId' : station
            }
        })
        .then(function (response) {
            console.log(response.data);
            data = response.data;
        })
        .catch(function (error) {
        })     
        return data;
    }

    async function getNewTaipeiStop() {    
        let route = "{{ route('get_newtaipei_stop')}}";
        let data = '';
        await axios({
            url: route,
            method: "get",
            params: {
                'stationId' : station
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

    function setBusData(data, data1) {
        // 清除原本的欄位
        document.querySelector('#bus_name').textContent = data[0]['StopName']['Zh_tw'];
        let table = document.querySelector('#clonetest');
        let trTable = document.querySelector('.rifo')
        for(let i = 0; i < data.length; i++){
            if(data[i]['StopStatus'] === 0 || data[i]['StopStatus'] === 1){
                const divComponent = document.querySelector(".divClone").cloneNode(true);
                const trComponent = document.querySelector(".tr_rifo").cloneNode(true);
                divComponent.querySelector(".custom-control-input").classList.add('busCheck');
                divComponent.querySelector(".custom-control-input").setAttribute('id', 'rideInfo_bus_checkbox' + [i]);
                divComponent.querySelector(".custom-control-input").setAttribute('name', 'rideInfo_checkbox_type' + [i]);
                divComponent.querySelector(".custom-control-input").setAttribute('value', data[i]['RouteName']['Zh_tw']);
                divComponent.querySelector(".custom-control-label").setAttribute('for', 'rideInfo_bus_checkbox'+ [i]);
                divComponent.querySelector(".bustext").textContent = data[i]['RouteName']['Zh_tw'];
                trComponent.classList.remove('d-none');
                trComponent.querySelector(".route_name").textContent = data[i]['RouteName']['Zh_tw'];
                document.querySelector("#rideInfo_type_checkbox_99").checked = true;

                divComponent.classList.remove('d-none');

                table.append(divComponent);
                trTable.append(trComponent);
            }
        }
        return;
    }

    function setBusStatus(data, data1){
        let trComponent;
        let cloneTable = clearTable();
        let table = document.querySelector('.tableClone');
        for(let i=0; i<data1.length; i++) {
            data.push(data1[i]);
        }
        if(data.length !== 0){
            for(let i = 0; i < data.length; i++){
                trComponent = cloneTable.cloneNode(true);
                let EstimateTime = data[i]['EstimateTime'];
                const time0 = Math.ceil(EstimateTime/60);
                if(data[i]['StopStatus'] === 0){
                    trComponent.querySelector('.RouteName').textContent = data[i]['RouteName']['Zh_tw'];
                    if(time0 === 0){
                        trComponent.querySelector('.EstimateTime').textContent = "進站中";
                        trComponent.setAttribute('value', time0);
                    }else {
                        trComponent.querySelector('.EstimateTime').textContent = time0 + "分";
                        trComponent.setAttribute('value', time0);
                    }
                }
                else if(data[i]['StopStatus'] === 1){
                    trComponent.querySelector('.RouteName').textContent = data[i]['RouteName']['Zh_tw'];
                    trComponent.querySelector('.EstimateTime').textContent = "尚未發車";
                    trComponent.setAttribute('value', 96);
                }
                else if(data[i]['StopStatus'] === 2){
                    trComponent.querySelector('.RouteName').textContent = data[i]['RouteName']['Zh_tw'];
                    trComponent.querySelector('.EstimateTime').textContent = "交管不停靠";
                    trComponent.setAttribute('value', 98);
                }
                else if(data[i]['StopStatus'] === 3){
                    trComponent.querySelector('.RouteName').textContent = data[i]['RouteName']['Zh_tw'];
                    trComponent.querySelector('.EstimateTime').textContent = "末班車已過";
                    trComponent.setAttribute('value', 97);
                }
                else if(data[i]['StopStatus'] === 4){
                    trComponent.querySelector('.RouteName').textContent = data[i]['RouteName']['Zh_tw'];
                    trComponent.querySelector('.EstimateTime').textContent = "今日未營運";
                    trComponent.setAttribute('value', 99);
                }
                trComponent.classList.add('sort');
    
                trComponent.classList.remove('d-none');
                table.append(trComponent);
            }
            sortBusTime();
        } else {
            trComponent = cloneTable.cloneNode(true);
            trComponent.querySelector('.RouteName').textContent = "查無資訊";
            trComponent.querySelector('.EstimateTime').textContent = "查無資訊";
            trComponent.setAttribute('value', 97);
            table.append(trComponent);
        }

    }

    function sortBusTime() {
        let rows = document.querySelectorAll('.sort')
        let dataSort = [];
        let table = document.querySelector('.tableClone')
        for(i=0; i<rows.length; i++) {
            dataSort.push({element: rows[i], value: rows[i].getAttribute("value")});
            // let data = rows[i].getAttribute('value');
            // dataSort.push(data); 
        }
        dataSort.sort(function (a, b){
            return a.value - b.value;
        });

        for(j=0; j<dataSort.length; j++) {
            table.append(dataSort[j].element);
        }

        // let table = document.querySelector('.tableClone');

    }

    function formSumbit(){
        onFormSubmit();
    }

    function onFormSubmit() {
        checkStop();
        if(!userPosition){
            return;
        }
        let check = verifySubmit();
        if(!check) {
            return;
        }
        const busNumber = document.querySelectorAll(".busNumber input[type=checkbox]:checked");
        const rideInfo = document.querySelectorAll(".rideInfo input[type=checkbox]:checked");
        const stationName = document.querySelector('#bus_name').textContent;
        let route = "{{ route('bus_rifo_create') }}"
        let dataNumber = [];
        let dataType = [];
        for(let i =0; i<busNumber.length; i++){
            dataNumber.push(busNumber[i].value);
        }

        for(let i = 0; i<rideInfo.length; i++) {
            dataType.push(rideInfo[i].value);
        }

        for(let i = 0; i<dataNumber.length; i++) {
            let test = typeof(dataNumber[i]);

        }   
        

        axios({
            url: route,
            method: 'POST',
            data: {
                'stationId' : station,
                'station_name' : stationName,
                'number' : dataNumber,
                'type' : dataType,
            }
        })
        .then(function (response) {
            // swal.('預約成功');
            Swal.fire({
                position: 'top',
                icon: 'success',
                title: '預約成功',
                showConfirmButton: false,
                timer: 1000
            })
            return;
        })
        .catch(function (error) {
            return;
        })
    }

    function resetCheckbox(el){
        let check = el.checked;
        if(check) {
            document.querySelector("#rideInfo_type_checkbox_0").checked = "";
            document.querySelector("#rideInfo_type_checkbox_1").checked = "";
            document.querySelector("#rideInfo_type_checkbox_2").checked = "";
            document.querySelector("#rideInfo_type_checkbox_3").checked = "";
            document.querySelector("#rideInfo_type_checkbox_4").checked = "";
            document.querySelector("#rideInfo_type_checkbox_5").checked = "";
        }
    }

    function setcheckbox(el){
        let check = el.checked;
        if(check) {
            document.querySelector("#rideInfo_type_checkbox_99").checked = "";
        }
    }

    async function updateTimer() {
        let seconds = countdown % 60;
        let timerDiv = document.getElementById("timer");
        timerDiv.innerHTML = "更新倒數 " + seconds.toString().padStart(1, "0") + " 秒";
        
        if (countdown === 0) {
            let taipeiStops = await getTaipeiStop();
            let newTaipeiStops = await getNewTaipeiStop();
            // 重置倒數計時器為起始時間
            countdown = 15; 
            clearInterval(timer);
            timerDiv.innerHTML = "更新倒數 15 秒"
            // 重設計時器
            timer = setInterval(updateTimer, 1000); 
            setBusStatus(taipeiStops, newTaipeiStops);

        }
        countdown--;
    }

    function clearTable() {
        let table = document.querySelectorAll('.tr-template');
        let originalTable = table[0];
        for(i=0; i<table.length; i++) {
            table[i].parentNode.removeChild(table[i]);
        }
        return originalTable;
    }

    function clearModalTable() {
        let table = document.querySelectorAll('.reserve');
        for(i = 0; i < table.length; i++){
            table[i].textContent = '尚未預約';
        }

    }

    function rifoModel() {
        // 取得按鈕和 Modal
        let route = "{{ route('get_stop_data') }}"
        axios({
            method: 'GET',
            url: route,
            params: {
                'stationId' : station
            }
        })
        .then(function (response) {
            setRifoModal(response.data);
        })
        .catch(function (error) {
        })
        return;
    }
    function setRifoModal(data){
        clearModalTable();
        let busNumber = [];
        let table = document.querySelectorAll('.tr_rifo');
        data.forEach(rifo => {
            rifo.buses.forEach(bus => {
                busNumber.push(bus);
            });
        });
        for(j = 0; j < table.length; j++){
            let bus = table[j].querySelector('.route_name').textContent;
            let type = table[j].querySelector('.reserve');
            for(i = 0; i < busNumber.length; i++){
                if(bus === busNumber[i]){
                    type.textContent = '已預約';
                } 
            }
        }
    }

    function verifySubmit() {
        const busNumber = document.querySelectorAll(".busNumber input[type=checkbox]:checked");
        if(busNumber.length !== 0) {
            return true;
        } else {
            Swal.fire({
                title: '請填寫乘車資訊',
                icon: 'error',
                showCancelButton: false,
                confirmButtonText: '確定',
                })
        }
    }
</script>