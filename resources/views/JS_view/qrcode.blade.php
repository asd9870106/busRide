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
            setQrcode(response.data);
        })
        .catch(function (error) {
            Swal.fire({
                title: '查無站牌',
                icon: 'warning',
                showCancelButton: false,
                confirmButtonText: '確定',
                })
        })
    }

    function setQrcode(data) {
        document.querySelector('.busqrcode').classList.remove('d-none');
        document.querySelector('.stopName0').textContent = data[0].station_name;
        document.querySelector('.stopName1').textContent = data[1].station_name;
        let data0 = data[0].station_id;
        let data1 = data[1].station_id;
        let stationId0 = document.querySelector('#qrcode0');
        let stationId1 = document.querySelector('#qrcode1');
        let url0 = "http://127.0.0.1:8000/station/?station=" + data0

        let qrcode0 = new QRCode(document.querySelector('#qrcode0'), {
            text: url0,
            width: 256,
            height: 256,
            correctLevel: QRCode.CorrectLevel.H

        });

        let qrcode1 = new QRCode(stationId1, {
            text: "http://127.0.0.1:8000/station/?station=" + data1,
            width: 256,
            height: 256,
            correctLevel: QRCode.CorrectLevel.H

        });
    }

</script>