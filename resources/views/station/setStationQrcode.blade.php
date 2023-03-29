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
        })
        .catch(function (error) {
            return;
        })
    }
</script>
@endsection