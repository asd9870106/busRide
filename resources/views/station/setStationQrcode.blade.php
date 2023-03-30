@extends('default')

@section('header')
    @include('layouts.header')
@endsection


@section('contents')
<div class="container-fluid">
    <div class="grid m-3">
        <div id="Div_foundation_list">
            {{-- 搜尋欄位 --}}
            <div class="row justify-content-center">
                <div class="forminput">
                    <label class="formtext m-3" for="station">站牌:</label>
                    <input type="text" name="station" id="station" class="bus">
                    <button class="formButton m-3" onclick="getQrcode()" type="submit">搜尋</button>
                </div>
            </div>
            @yield('test')
        </div>
        <div class="row">
            <div class="cos-12 table-responsive">
                <table class="table table-bordered align-middle text-center busqrcode">
                    <thead class="thead-light">
                        <tr>
                            <th style="width:5%">StationID</th>
                            <th style="width:15%">站牌</th>
                            <th style="width:30%">地址</th>
                            <th style="width:50%">QR code</th>
                        </tr>
                    </thead>
                    <tbody class="stationQrcode">
                        <tr class=" d-none">
                            <td class="stationId"></td>
                            <td class="stopName"></td>
                            <td class="address"></td>
                            <td class="qrcode"><img id="qrcode" src="" alt=""></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</div>
<script> 
    function getQrcode(){
        let route = "{{ route('get_station_qrcode') }}"
        let stationName = document.querySelector('#station').value;
        axios({
            url: route,
            method: 'get',
            params: {
                'station_name' : stationName
            }
        })
        .then(function (response) {
            console.log(response.data);
            setQrcode(response.data);
        })
        .catch(function (error) {
            return;
        })
    }

    function setQrcode(data) {
        let table = document.querySelector('.stationQrcode');
        for(i = 0; i < data.length; i++){
            let trClone = document.querySelector('.stationQrcode tr').cloneNode(true);
            trClone.classList.remove('d-none');
            trClone.querySelector('.stationId').textContent = data[i]['station_id'];
            trClone.querySelector('.stopName').textContent = data[i]['station_name'];
            trClone.querySelector('.address').textContent = data[i]['station_address'];
            trClone.querySelector('.qrcode img').src = data[i].qrcode_image;
            table.append(trClone);
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

</script>
@endsection