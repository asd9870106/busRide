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
                        <label class="formtext m-3" for="route">查詢目的地附近站牌:</label>
                        <input type="text" name="route" id="route" class="bus">
                        <button class="formButton m-3" onclick="onSubmit()">搜尋</button>
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
                    <thead class="thead-light">
                        <tr>
                            <th style="width:15%">出發點</th>
                            <th style="width:15%">目的地</th>
                            <th style="width:10%">經過路線</th>
                            <th style="width:12%">QR code</th>
                        </tr>
                    </thead>
                    <tbody class="stationQrcode">
                        <tr class="tr-template">
                            <td class="stopName0">
                                <span class="m-2" id="stopName"></span>
                                <br>
                                <span class="m-2" id="stopAddress"></span>
                            </td>
                            <td class="stopName1">
                                <span class="m-2" id="stopName1"></span>
                                <br>
                                <span class="m-2" id="stopAddress1"></span>
                            </td>
                            <td class="stopAddress0"></td>
                            <td class="qrcode text-center"><img class="image d-none" id="image0" src="" alt=""></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include('JS_view.nearby')

@endsection