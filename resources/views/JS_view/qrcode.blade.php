
<script>
    function onSubmit() {
        let data = document.querySelector('#station').value;
        let route = "{{ route('get_stationid') }}"
        axios({
            url : route,
            method : "GET",
            params : {
                'station' : data
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
    }

    function setQrcode(data) {
        
        document.querySelector('.busqrcode').classList.remove('d-none');
        document.querySelector('.stopName0').textContent = data[0].station_name;
        document.querySelector('.stopName1').textContent = data[1].station_name;
        document.querySelector('.stopAddress0').textContent = data[0].station_address;
        document.querySelector('.stopAddress1').textContent = data[1].station_address;
        let data0 = data[0].station_id;
        let data1 = data[1].station_id;
        let stationId0 = document.getElementById('image0');
        let stationId1 = document.getElementById('image1');

        getQrcode(data0, stationId0);
        getQrcode(data1, stationId1);        

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





    
</script>