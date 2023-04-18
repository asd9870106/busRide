
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
        let trComponent;
        let cloneTable = clearTable();
        let table = document.querySelector('.stationQrcode');

        document.querySelector('.busqrcode').classList.remove('d-none');
        for(let i = 0; i < data.length; i=i+2){
            trComponent = cloneTable.cloneNode(true);
            trComponent.querySelector('.stopName0').textContent = data[i].station_name;
            trComponent.querySelector('.stopName1').textContent = data[i+1].station_name;
            trComponent.querySelector('.stopAddress0').textContent = data[i].station_address;
            trComponent.querySelector('.stopAddress1').textContent = data[i+1].station_address;
            let stationId0 = data[i].station_id;
            let stationId1 = data[i+1].station_id;
            let image0 = trComponent.querySelector('#image0');
            let image1 = trComponent.querySelector('#image1');
    
            getQrcode(stationId0, image0);
            getQrcode(stationId1, image1);       
            table.append(trComponent); 
        }

    }

    function clearTable() {
        let table = document.querySelectorAll('.tr-template');
        let originalTable = table[0];
        for(i=0; i<table.length; i++) {
            table[i].parentNode.removeChild(table[i]);
        }
        return originalTable;
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