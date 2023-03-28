<script>

    let url = new URLSearchParams(window.location.search);
    const routeId = url.get('route');
    const busName = url.get('busName');
    document.querySelector('.bus_number').textContent = routeId;
    document.querySelector('.bus_license_plate').textContent = busName;
    let rifo_id = [];
    let countdown = 15;
    let timer = setInterval(updateTimer, 1000);
    let tempStopSequence = 0;

    window.onload = function() {
        
        init();
    }

    async function init (){
        let data = await getTaipeiBusData();
        if(data.length === 0){
            data = await getNewTaipeiBusData();
        }
        setBusData(data);
        
    }
    async function getTaipeiBusData() {    
        let route = "{{ route('get_driver_taipei_data') }}"
        let data = '';
        await axios({
            url: route,
            method: "get",
            params: {
                'busNumber' : routeId
            }
        })
        .then(function (response) {
            data = response.data;            
        })
        .catch(function (error) {
        })     
        return data; 
    }
    async function getNewTaipeiBusData() {    
        let route = "{{ route('get_driver_newtaipei_data') }}"
        let data = '';
        await axios({
            url: route,
            method: "get",
            params: {
                'busNumber' : routeId
            }
        })
        .then(function (response) {
            data = response.data;            
        })
        .catch(function (error) {
        })     
        return data; 
    }
    async function setBusData(data){
        console.log(data);
        let stop_0 = document.querySelector('.next_stop');
        let stop_1 = document.querySelector('.next_stop_1');
        let stop_2 = document.querySelector('.next_stop_2');
        let stop_3 = document.querySelector('.next_stop_3');
        let stopName0 = document.querySelector('.nextStop');
        let stopName1 = document.querySelector('.nextStop1');
        let stopName2 = document.querySelector('.nextStop2');
        let stopName3 = document.querySelector('.nextStop3');
        let direction = checkBusNumber(data);
        let display = await getTaipeiStop();
        if(display.length === 0) {
            display = await getNewTaipeiStop();
        }
        let StopSequence = checkStopSequence(data);
        let direction_1 = display[0].Stops;
        let direction_2 = display[1].Stops;

        if(direction !== undefined){
            if(direction === 0) {
                for(let i = 0; i < direction_1.length; i++){
                    if(direction_1[i].StopSequence === StopSequence){
                        if(tempStopSequence !== StopSequence){
                            if(rifo_id.length !== 0){
                                for(let j = 0; j < rifo_id.length; j++){
                                    console.log(rifo_id[j]);
                                    removeRifo(rifo_id[j]);
                                }
                            }
                        }
                        tempStopSequence = StopSequence;
    
                        if(direction_1[i+1] === undefined){
                            stopName0.textContent = direction_2[0].StopName.Zh_tw;
                            stopName1.textContent = direction_2[1].StopName.Zh_tw;
                            stopName2.textContent = direction_2[2].StopName.Zh_tw;
                            stopName3.textContent = direction_2[3].StopName.Zh_tw;
                            let stationId_1 = direction_2[0].StationID;
                            let stationId_2 = direction_2[1].StationID;
                            let stationId_3 = direction_2[2].StationID;
                            let stationId_4 = direction_2[3].StationID;
                            let data1 = await getStopDetail(stationId_1);
                            let data2 = await getStopDetail(stationId_2);
                            let data3 = await getStopDetail(stationId_3);
                            let data4 = await getStopDetail(stationId_4);
                            setNextStop(data1, stop_0);
                            setRideData(data2, stop_1);
                            setRideData(data3, stop_2);
                            setRideData(data4, stop_3);
                        } else if(direction_1[i+2] === undefined) {
                            stopName0.textContent = direction_1[i+1].StopName.Zh_tw;
                            stopName1.textContent = direction_2[0].StopName.Zh_tw;
                            stopName2.textContent = direction_2[1].StopName.Zh_tw;
                            stopName3.textContent = direction_2[2].StopName.Zh_tw;
                            let stationId_1 = direction_1[i+1].StationID;
                            let stationId_2 = direction_2[0].StationID;
                            let stationId_3 = direction_2[1].StationID;
                            let stationId_4 = direction_2[2].StationID;
                            let data1 = await getStopDetail(stationId_1);
                            let data2 = await getStopDetail(stationId_2);
                            let data3 = await getStopDetail(stationId_3);
                            let data4 = await getStopDetail(stationId_4);
                            setNextStop(data1, stop_0);
                            setRideData(data2, stop_1);
                            setRideData(data3, stop_2);
                            setRideData(data4, stop_3);
                        } else if(direction_1[i+3] === undefined) {
                            stopName0.textContent = direction_1[i+1].StopName.Zh_tw;
                            stopName1.textContent = direction_1[i+2].StopName.Zh_tw;
                            stopName2.textContent = direction_2[0].StopName.Zh_tw;
                            stopName3.textContent = direction_2[1].StopName.Zh_tw;
                            let stationId_2 = direction_1[i+2].StationID;
                            let stationId_1 = direction_1[i+1].StationID;
                            let stationId_3 = direction_2[0].StationID;
                            let stationId_4 = direction_2[1].StationID;
                            let data1 = await getStopDetail(stationId_1);
                            let data2 = await getStopDetail(stationId_2);
                            let data3 = await getStopDetail(stationId_3);
                            let data4 = await getStopDetail(stationId_4);
                            setNextStop(data1, stop_0);
                            setRideData(data2, stop_1);
                            setRideData(data3, stop_2);
                            setRideData(data4, stop_3);
                        } else if(direction_1[i+4] === undefined) {
                            stopName0.textContent = direction_1[i+1].StopName.Zh_tw;
                            stopName1.textContent = direction_1[i+2].StopName.Zh_tw;
                            stopName2.textContent = direction_1[i+3].StopName.Zh_tw;
                            stopName3.textContent = direction_2[0].StopName.Zh_tw;
                            let stationId_1 = direction_1[i+1].StationID;
                            let stationId_2 = direction_1[i+2].StationID;
                            let stationId_3 = direction_1[i+3].StationID;
                            let stationId_4 = direction_2[0].StationID;
                            let data1 = await getStopDetail(stationId_1);
                            let data2 = await getStopDetail(stationId_2);
                            let data3 = await getStopDetail(stationId_3);
                            let data4 = await getStopDetail(stationId_4);
                            setNextStop(data1, stop_0);
                            setRideData(data2, stop_1);
                            setRideData(data3, stop_2);
                            setRideData(data4, stop_3);
                        }
                        else{
                            stopName0.textContent = direction_1[i+1].StopName.Zh_tw;
                            stopName1.textContent = direction_1[i+2].StopName.Zh_tw;
                            stopName2.textContent = direction_1[i+3].StopName.Zh_tw;
                            stopName3.textContent = direction_1[i+4].StopName.Zh_tw;
                            let stationId_1 = direction_1[i+1].StationID;
                            let stationId_2 = direction_1[i+2].StationID;
                            let stationId_3 = direction_1[i+3].StationID;
                            let stationId_4 = direction_1[i+4].StationID;
                            let data1 = await getStopDetail(stationId_1);
                            let data2 = await getStopDetail(stationId_2);
                            let data3 = await getStopDetail(stationId_3);
                            let data4 = await getStopDetail(stationId_4);
                            setNextStop(data1, stop_0);
                            setRideData(data2, stop_1);
                            setRideData(data3, stop_2);
                            setRideData(data4, stop_3);
                        }
                    }
                }
            } else if(direction === 1){
                for(let i = 0; i < direction_2.length; i++){
                    if(direction_2[i].StopSequence === StopSequence){
                        if(tempStopSequence !== StopSequence){
                            if(rifo_id.length !== 0){
                                for(let j = 0; j < rifo_id.length; j++){
                                    console.log(rifo_id[j]);
                                    removeRifo(rifo_id[j]);
                                }
                            }
                        }
                        tempStopSequence = StopSequence;
                        if(direction_2[i+1] === undefined){
                            Swal.fire('抵達終點站')
                        } else if(direction_2[i+2] === undefined) {
                            document.querySelector('.nextStop3').textContent = direction_2[i+1].StopName.Zh_tw;
                            let stationId_4 = direction_2[i+1].StationID;
                            let data4 = await getStopDetail(stationId_4);
                            setRideData(data4, stop_3);
                        } else if(direction_2[i+3] === undefined) {
                            document.querySelector('.nextStop2').textContent = direction_2[i+1].StopName.Zh_tw;
                            document.querySelector('.nextStop3').textContent = direction_2[i+2].StopName.Zh_tw;
                            let stationId_3 = direction_2[i+1].StationID;
                            let stationId_4 = direction_2[i+2].StationID;
                            let data3 = await getStopDetail(stationId_3);
                            let data4 = await getStopDetail(stationId_4);
                            setRideData(data3, stop_2);
                            setRideData(data4, stop_3);
                        } else if(direction_2[i+4] === undefined) {
                            stopName0.textContent = direction_2[i+1].StopName.Zh_tw;
                            stopName1.textContent = direction_2[i+2].StopName.Zh_tw;
                            stopName2.textContent = direction_2[i+3].StopName.Zh_tw;
                            let stationId_2 = direction_2[i+1].StationID;
                            let stationId_3 = direction_2[i+2].StationID;
                            let stationId_4 = direction_2[i+3].StationID;
                            let data2 = await getStopDetail(stationId_2);
                            let data3 = await getStopDetail(stationId_3);
                            let data4 = await getStopDetail(stationId_4);
                            setRideData(data2, stop_1);
                            setRideData(data3, stop_2);
                            setRideData(data4, stop_3);
                        } else {
                            stopName0.textContent = direction_2[i+1].StopName.Zh_tw;
                            stopName1.textContent = direction_2[i+2].StopName.Zh_tw;
                            stopName2.textContent = direction_2[i+3].StopName.Zh_tw;
                            stopName3.textContent = direction_2[i+4].StopName.Zh_tw;
                            let stationId_1 = direction_2[i+1].StationID;
                            let stationId_2 = direction_2[i+2].StationID;
                            let stationId_3 = direction_2[i+3].StationID;
                            let stationId_4 = direction_2[i+4].StationID;
                            let data1 = await getStopDetail(stationId_1);
                            let data2 = await getStopDetail(stationId_2);
                            let data3 = await getStopDetail(stationId_3);
                            let data4 = await getStopDetail(stationId_4);
                            setNextStop(data1, stop_0);
                            setRideData(data2, stop_1);
                            setRideData(data3, stop_2);
                            setRideData(data4, stop_3);
                        }
                    }
                }
            }
        } else {
            Swal.fire({
                title: '未發車',
                icon: 'warning',
                showCancelButton: false,
                confirmButtonText: '重新整理',
                }).then((result) => {
                    init();
                })
        }
    }

    // 公車路線的所有站位資料
    async function getTaipeiStop(){
        let route = "{{ route('get_driver_taipei_stop') }}"
        let data;
        await axios({
            url: route,
            method: "get",
            params: {
                'busNumber' : routeId
            }
        })
        .then(function (response) {
            data = response.data;            
        })
        .catch(function (error) {
        })     
        return data;
    }
    async function getNewTaipeiStop(){
        let route = "{{ route('get_driver_newtaipei_stop') }}"
        let data;
        await axios({
            url: route,
            method: "get",
            params: {
                'busNumber' : routeId
            }
        })
        .then(function (response) {
            data = response.data;            
        })
        .catch(function (error) {
        })     
        return data;
    }

    function updateTimer() {
        let seconds = countdown % 60;

        let timerDiv = document.getElementById("timer");
        timerDiv.innerHTML = "更新倒數 " + seconds.toString().padStart(1, "0") + " 秒";

        if (countdown === 0) {
            // 重置倒數計時器為起始時間
            countdown = 15; 
            clearInterval(timer);
            timerDiv.innerHTML = "更新倒數 15 秒"
            // 重設計時器
            timer = setInterval(updateTimer, 1000); 
            init();
        }
        countdown--;
    }
    async function getStopDetail(stationId){
        let route = "{{ route('get_stop_data') }}";

        console.log(stationId);

        let data = '';
        await axios({
            method: 'GET',
            url: route,
            params: {
                'stationId' : stationId
            }
        })
        .then(function (response) {
            data = response.data;
        })
        .catch(function (error) {
            data = null;
        })
        return data;
    }

    function setRideData(data, stop) {
        // console.log(data);
        stop.checked = false;
        if(data !== null){
            data.forEach(element => {
                let bus = element.buses;
                for(i = 0; i < bus.length; i++){
                    if(bus[i] === routeId) {
                        stop.checked = true;
                        stop.classList.remove('d-none');
                    }
                }
            });
        }
    }

    function setNextStop(data){
        console.log(data);
        resetShowRifo();
        rifo_id = [];
        if(data !== null){
            for(let i = 0;i < data.length;i++){
                let busNumber = data[i].buses;
                let busType = data[i].type;
                for(j = 0;j < busNumber.length; j++){
                    if(busNumber[j] === routeId){
                        rifo_id.push(data[i].id);
                        document.querySelector('.next_stop').checked = true;
                        document.querySelector('.next_stop').classList.remove('d-none');
                        showRifo(busType);
                    }
                }
            }
        } 
    }

    // 找到公車的方向
    function checkBusNumber(data){
        for(let i = 0; i < data.length;i++){
            if(data[i].PlateNumb === busName){
                let direction = data[i].Direction;
                return direction;
            }
        }
    }

    // 找到公車在哪站
    function checkStopSequence(data){
        for(let i = 0; i < data.length;i++){
            if(data[i].PlateNumb === busName){
                let stopSequence = data[i].StopSequence;
                return stopSequence;
            }
        }
    }

    function showRifo(data) {
        for(let i = 0;i < data.length;i++){
            if(data[i] === 1){
                document.querySelector('.accessible').classList.remove('d-none');
            } else if(data[i] === 7) {
                document.querySelector('.general').classList.remove('d-none');                
            } else {
                document.querySelector('.fraternity').classList.remove('d-none');
            }
        }
        return;
    }
    function resetShowRifo(){
        document.querySelector('.next_stop').checked = false;
        document.querySelector('.next_stop').classList.add('d-none');
        document.querySelector('.accessible').classList.add('d-none');
        document.querySelector('.general').classList.add('d-none');
        document.querySelector('.fraternity').classList.add('d-none');
    }

    function removeRifo(id){
        let route = "{{ route('delete_stop_data')}}";
        axios({
            url: route,
            method: 'DELETE', 
            params: {
                'id' : id
            }
        })
        .then(function (response) {
            console.log(respons.data);
        })
        .catch(function (error) {
            return;
        })
    }
</script>