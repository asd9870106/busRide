<script>
// ajax
    
    window.onload = function() {
        
        getBusData();
        getQrCode();
    }

    function getBusData() {    
        let route = "{{ route('get_bus_station')}}";
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

    var x = document.getElementById("demo");

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else { 
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showPosition(position) {
        x.innerHTML = "Latitude: " + position.coords.latitude + 
        "<br>Longitude: " + position.coords.longitude;
    }


</script>