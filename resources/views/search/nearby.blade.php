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
                    {{-- <div class="forminput col-6">
                        <label class="formtext m-3" for="route">查詢附近站牌:</label>
                        <input type="text" name="route" id="route" class="bus">
                        <button class="formButton m-3" onclick="onSubmit()">搜尋</button>
                    </div> --}}
                    <div class="forminput">
                        <label class="formtext m-3" for="route">查詢目的地:</label>
                        <input type="text" name="route" id="addressInput" class="bus">
                        <button class="formButton m-3" onclick="searchAddress()">搜尋</button>
                        <button class="formButton " onclick="onSubmit()">規劃路線</button>
                        {{-- <button class="userposition m-3" onclick="()">回到使用者位置</button> --}}
                    </div>


            </div>
            @yield('test') 
        </div>
        <div class="row m-3">
            <div id="map" style="width: 1800px; height: 400px"></div>
        </div>
        <div class="row m-3">
            <div class="cos-12 table-responsive">
                <table class="table table-bordered align-middle busqrcode d-none">
                    <thead class="thead-light text-center">
                        <tr>
                            <th style="width:15%">搭乘方式</th>
                            <th style="width:5%">搭乘路線</th>
                            <th style="width:20%">站牌QRcode</th>
                            <th style="width:3%">轉乘次數</th>
                            <th style="width:3%">票價</th>
                        </tr>
                    </thead>
                    <tbody class="stationQrcode">
                        
                    </tbody>

                    <tr class="tr-template d-none">
                        <td class="embark">
                            <div class="d-none" id="embark">
                                <span class="m-2" id="departure"></span>
                                <span class="m-2" id="dash">⟶</span>
                                <span class="m-2" id="arrival"></span>
                            </div>
                            {{-- <br> --}}
                            {{-- <span class="m-2" id="stopAddress"></span> --}}
                        </td>
                        <td class="route">
                            <div class="m-2 d-none" id="route"></div>
                        </td>
                        <td class="qrcode text-center">
                            <div class="qrcodeView d-none" id="qrcode">
                                <a class="busRide">
                                    <img class="image" id="image0" src="" alt="">
                                </a>
                                <div id="qrcodeName"></div>
                            </div>
                        </td>
                        <td class="transfers text-center">
                            <span class="m-2" id="transfers"></span>
                        </td>
                        <td class="price text-center">
                            <span class="m-2" id="price"></span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@include('JS_view.nearby')

@endsection