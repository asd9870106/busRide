<script>
// ajax
    
    window.onload = function() {
        
        getBusData();
        getQrCode();
    }

    function getBusData() {    
        let route = "{{ route('get_bus_data')}}";
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
    function getQrCode() {
        let route = "{{ route('get_QR_code') }}"
        axios({
            url: route,
            method: "get",
        })
        .then(function (response) {
            console.log(response);
        })
        .catch(function (error) {
            return 404;
        })
    }


</script>