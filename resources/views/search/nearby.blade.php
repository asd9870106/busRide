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
                        <label class="formtext m-3" for="route">查詢附近站牌:</label>
                        <input type="text" name="route" id="route" class="bus">
                        {{-- <label class="formtext m-3" for="busName">公車車牌:</label>
                        <input type="text" name="busName" id="busName" class="bus"> --}}
                        <button class="formButton m-3" onclick="onSubmit()">搜尋</button>
                    </div>

            </div>
            @yield('test') 
        </div>
        <div class="">
            {{-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1807.3617927339537!2d121.53299995947025!3d25.043452981542078!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3442a97d255598df%3A0x47ea748e8f3f53aa!2z5ZyL56uL6Ie65YyX56eR5oqA5aSn5a24!5e0!3m2!1szh-TW!2stw!4v1682321531442!5m2!1szh-TW!2stw"
                    width="600" 
                    height="450" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
            </iframe> --}}
            <div id="map" style="width: 400px; height: 400px"></div>
            <div id="coordinates"></div>
            <div class="cos-12 table-responsive">
                <table class="table table-bordered align-middle text-center busqrcode d-none">
                    <thead class="thead-light">
                        <tr>
                            <th style="width:10%">站牌</th>
                            <th style="width:28%">地址</th>
                            <th style="width:12%">QR code</th>
                            <th style="width:10%">站牌</th>
                            <th style="width:28%">地址</th>
                            <th style="width:12%">QR code</th>
                        </tr>
                    </thead>
                    <tbody class="stationQrcode">
                        <tr class="tr-template">
                            <td class="stopName0"></td>
                            <td class="stopAddress0"></td>
                            <td class="qrcode"><img class="image" id="image0" src="" alt=""></td>
                            <td class="stopName1"></td>
                            <td class="stopAddress1"></td>
                            <td class="qrcode"><img class="image" id="image1" src="" alt=""></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include('JS_view.nearby')

@endsection