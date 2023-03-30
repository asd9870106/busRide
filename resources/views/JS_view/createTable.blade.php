<script>

    window.onload = function () {
        init();
    }

    function init() {
        getBusStation();
        // getBusNumber();
    }

    function getBusStation() {
        let route = "{{ route('get_bus_station')}}"
        axios({
            url:route,
            method:"GET",
        })
        .then(function (response) {
            console.log(response.data);
            setQrcode(response);
            setBusdata(response);
            
        })
        .catch(function (error) {
            console.log(error);
            return;
        })
    }
    
    function setQrcode(data) {
        let route = "{{ route('create_station_qrcode') }}"
        axios({
            url: route,
            method: 'post',
            data: data
        })
        .then(function (response) {
            console.log(response);
        })
        .catch(function (error) {
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

    // function setQrcode(data) {
    //     let route = "{{ route('create_station_qrcode') }}"
    //     axios({
    //         url: route,
    //         method: 'POST',
    //         data: data
    //     })
    //     .then(function (response) {
    //         console.log(response);
    //     })
    //     .catch(function (error) {
    //         return;
    //     })
    // }

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