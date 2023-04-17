
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

    async function setQrcode(data) {
        document.querySelector('.busqrcode').classList.remove('d-none');
        document.querySelector('.stopName0').textContent = data[0].station_name;
        document.querySelector('.stopName1').textContent = data[1].station_name;
        let data0 = data[0].station_id;
        let data1 = data[1].station_id;
        let stationId0 = document.getElementById('qrcode0');
        let stationId1 = document.getElementById('qrcode1');
        let url0 = "http://127.0.0.1:8000/station/?station=" + data0;
        let url1 = "http://127.0.0.1:8000/station/?station=" + data1;
        createQRCode(url0, stationId0);
        createQRCode(url1, stationId1);        

    }

    function createQRCode(text, container) {
        new QRCode(container, {
            text: text,
            width: 256,
            height: 256,
            colorDark: '#000000',
            colorLight: '#ffffff',
            correctLevel: QRCode.QRErrorCorrectLevel.H,
        });
    }
    // var qrcode = new QRCode(document.getElementById("qrcode0"), {
    //     text: "https://www.example.com",
    //     width: 256,
    //     height: 256,
    //     colorDark: "#000000",
    //     colorLight: "#ffffff",
    //     correctLevel : QRCode.CorrectLevel.H
    // });

    // var qrcode1 = new QRCode(document.getElementById("qrcode1"), {
    //     text: "https://www.example.com",
    //     width: 256,
    //     height: 256,
    //     colorDark: "#000000",
    //     colorLight: "#ffffff",
    //     correctLevel : QRCode.CorrectLevel.H
    // });



    
</script>