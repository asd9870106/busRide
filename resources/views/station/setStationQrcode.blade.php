@extends('default')

@section('header')
    @include('layouts.header')
@endsection


@section('contents')
<div class="container-fluid">
    <div class="grid m-3">
        {{-- <div id="qrcode"></div> --}}
        <div id="Div_foundation_list">
            {{-- 搜尋欄位 --}}
            <div class="row justify-content-center">
                <form action="{{ route('get_station_qrcode') }}" method="post">
                    @csrf
                    <div class="forminput">
                        <label class="formtext m-3" for="station">stationId :</label>
                        <input type="text" name="station" id="station" class="bus">
                    </div>
                    <button class="formButton m-3" type="submit">搜尋</button>
                </form>
                
            </div>
            @yield('test') 
        </div>
        <div class="row">
            <div class="cos-12 table-responsive">
                <table class="table table-bordered align-middle text-center busqrcode">
                    <thead class="thead-light d-none">
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
        <div class="row">
            
        </div>
    </div>
    
</div>
<script> 
// 定義QR碼容器元素
var qrcodeContainer = document.getElementById('qrcode');
let 
// 定義QRCode實例
var qrcode = new QRCode(qrcodeContainer, {
  text: 'http://127.0.0.1:8000/station/?station=', // QR碼內容
  width: 256, // QR碼寬度
  height: 256, // QR碼高度
  colorDark : '#000000', // QR碼顏色
  colorLight : '#ffffff', // QR碼背景顏色
  correctLevel : QRCode.CorrectLevel.H // QR碼容錯等級
});
</script>
@endsection