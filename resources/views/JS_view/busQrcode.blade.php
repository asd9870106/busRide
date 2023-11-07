
<script>
    async function onSubmit() {
        let busBumber= document.querySelector('#route').value;
        let data;
        if(busBumber !== ''){
                data = await getTaipeiBusData(busBumber);
            if(data.length === 0){
                data = await getNewTaipeiBusData(busBumber);
            }
        } else {
            let taipeiData = await getTaipeiBusData(busBumber);
            let newTaipeiData = await getNewTaipeiBusData(busBumber);
            data = taipeiData.concat(newTaipeiData);
        }
        if(data.length === 0){
            Swal.fire({
                title: '查無路線',
                icon: 'warning',
                showCancelButton: false,
                confirmButtonText: '確定',
            });
        } else {
            console.log(data);
            setQrcode(data);
        }
        
    }
    
    async function getTaipeiBusData(routeId) {    
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

    async function getNewTaipeiBusData(routeId) {    
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

    function setQrcode(data) {
        let trComponent;
        let cloneTable = clearTable();
        let table = document.querySelector('.stationQrcode');

        document.querySelector('.busqrcode').classList.remove('d-none');
        for(let i = 0; i < data.length; i=i+3){
            trComponent = cloneTable.cloneNode(true);
            trComponent.querySelector('.route0').textContent = data[i].RouteName.Zh_tw;
            trComponent.querySelector('.busName0').textContent = data[i].PlateNumb;
            let route0 = data[i].RouteName.Zh_tw;
            let busName0 = data[i].PlateNumb;
            let image0 = trComponent.querySelector('#image0');
            getQrcode(image0, route0, busName0);
            if(data[i+1] !== undefined){
                trComponent.querySelector('.route1').textContent = data[i+1].RouteName.Zh_tw;
                trComponent.querySelector('.busName1').textContent = data[i+1].PlateNumb;
                let route1 = data[i+1].RouteName.Zh_tw;
                let busName1 = data[i+1].PlateNumb;
                let image1 = trComponent.querySelector('#image1');
                getQrcode(image1, route1, busName1);
            }  
            if(data[i+2] !== undefined) {
                trComponent.querySelector('.route2').textContent = data[i+2].RouteName.Zh_tw;
                trComponent.querySelector('.busName2').textContent = data[i+2].PlateNumb;
                let route2 = data[i+2].RouteName.Zh_tw;
                let busName2 = data[i+2].PlateNumb;
                let image2 = trComponent.querySelector('#image2');
                getQrcode(image2, route2, busName2);
            }
    
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

    function getQrcode(data, route, busName){
        let qrcode = "http://127.0.0.1:8000/driver/?route=" + route + "&busName=" + busName;
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