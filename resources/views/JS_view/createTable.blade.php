<script>

    window.onload = function () {
        init();
    }

    function init() {
        getBusStation();
        getNewTaipeiStation();
        getBusNumber();
    }

    // 取得台北市站牌資訊
    function getBusStation() {
        let route = "{{ route('get_taipei_station')}}"
        axios({
            url:route,
            method:"GET",
        })
        .then(function (response) {
            console.log(response.data);
            setBusdata(response);
            
        })
        .catch(function (error) {
            console.log(error);
            return;
        })
    }
    // 取得新北市站牌資訊
    function getNewTaipeiStation() {
        let route = "{{ route('get_newtaipei_station')}}"
        axios({
            url:route,
            method:"GET",
        })
        .then(function (response) {
            console.log(response.data);
            setBusdata(response);
            
        })
        .catch(function (error) {
            console.log(error);
            return;
        })
    }

    function setBusdata(data) {
        console.log(data);
        let route = "{{ route('create_bus_station') }}"
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