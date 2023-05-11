<script>

    window.onload = function () {
        init();
    }

    async function init() {
        let taipeiData = await getBusStation();
        let newTaipeiData = await getNewTaipeiStation();
        setBusdata(taipeiData, newTaipeiData);
        getBusNumber();
    }

    // 取得台北市站牌資訊
    async function getBusStation() {
        let route = "{{ route('get_taipei_station')}}"
        let data;
        await axios({
            url:route,
            method:"GET",
        })
        .then(function (response) {
            console.log(response.data);
            data = response.data;
            
        })
        .catch(function (error) {
            console.log(error);
            return;
        })
        return data;
    }
    // 取得新北市站牌資訊
    async function getNewTaipeiStation() {
        let route = "{{ route('get_newtaipei_station')}}"
        let data;
        await axios({
            url:route,
            method:"GET",
        })
        .then(function (response) {
            console.log(response.data);
            data = response.data;
            
        })
        .catch(function (error) {
            console.log(error);
            return;
        })
        return data;
    }

    function setBusdata(taipeiData, newTaipeiData) {


        let mergedArray = taipeiData.concat(newTaipeiData);

        let uniqueArray = mergedArray.filter((value, index, self) => {
            return self.findIndex(item => item.StationID === value.StationID) === index;
        });

        let data = uniqueArray.sort((a, b) => {
            return a.StationID - b.StationID;
        });
        console.log(data);
        let firstData = data.splice(0, 7000);
        let secondData = data;
        
        let route = "{{ route('create_bus_station') }}"

        axios({
            url:route,
            method: "POST",
            data: {
                'data' : firstData
            }
        })
        .then(function (response) {
            console.log(response.data);
        })
        .catch(function (error) {
            return;
        })

        axios({
            url:route,
            method: "POST",
            data: {
                'data' : secondData
            }
        })
        .then(function (response) {
            console.log(response.data);
        })
        .catch(function (error) {
            return;
        })
    }

    function getBusNumber() {
        let route = "{{ route('get_bus_number') }}"
        axios({
            url:route,
            method:"GET",
        })
        .then(function (response) {
            console.log(response.data);

            setBusNumber(response);
            
        })
        .catch(function (error) {
            console.log(error);
            return;
        })
    }

    function setBusNumber(data){
        console.log(data);
        let route = "{{ route('create_bus_number') }}"
        axios({
            url:route,
            method: "POST",
            data: data
        })
        .then(function (response) {
            console.log(response.data);
        })
        .catch(function (error) {
            return;
        })
    }
</script>