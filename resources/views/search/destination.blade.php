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
                        <label class="formtext m-3" for="route">目的地附近站牌:</label>
                        <input type="text" name="route" id="route" class="bus">
                        {{-- <label class="formtext m-3" for="busName">公車車牌:</label>
                        <input type="text" name="busName" id="busName" class="bus"> --}}
                        <button class="formButton m-3" onclick="onSubmit()">搜尋</button>
                    </div>

            </div>
            @yield('test') 
        </div>
        <div class="row">
            <div id="canvas"></div>
            
            <div class="cos-12 table-responsive">
                <table class="table table-bordered align-middle text-center busqrcode d-none">
                    <thead class="thead-light">
                        <tr>
                            <th style="width:10%">路線</th>
                            <th style="width:10%">車牌</th>
                            <th style="width:12%">QR code</th>
                            <th style="width:10%">路線</th>
                            <th style="width:10%">車牌</th>
                            <th style="width:12%">QR code</th>
                            <th style="width:10%">路線</th>
                            <th style="width:10%">車牌</th>
                            <th style="width:12%">QR code</th>
                        </tr>
                    </thead>
                    <tbody class="stationQrcode">
                        <tr class="tr-template">
                            <td class="route0"></td>
                            <td class="busName0"></td>
                            <td class="qrcode"><img class="image d-none" id="image0" src="" alt=""></td>
                            <td class="route1"></td>
                            <td class="busName1"></td>
                            <td class="qrcode"><img class="image d-none" id="image1" src="" alt=""></td>
                            <td class="route2"></td>
                            <td class="busName2"></td>
                            <td class="qrcode"><img class="image d-none" id="image2" src="" alt=""></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
{{-- @include('JS_view.busQrcode') --}}

@endsection