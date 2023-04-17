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
                        <label class="formtext m-3" for="station">站牌 :</label>
                        <input type="text" name="station" id="station" class="bus">
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
                            <th style="width:10%">站牌</th>
                            <th style="width:28%">地址</th>
                            <th style="width:12%">QR code</th>
                            <th style="width:10%">站牌</th>
                            <th style="width:28%">地址</th>
                            <th style="width:12%">QR code</th>
                        </tr>
                    </thead>
                    <tbody class="stationQrcode">
                        <tr class="">
                            <td class="stopName0"></td>
                            <td class="stopAddress0"></td>
                            <td class="qrcode"><img class="d-none image" id="image0" src="" alt=""></td>
                            <td class="stopName1"></td>
                            <td class="stopAddress1"></td>
                            <td class="qrcode"><img class="d-none image" id="image1" src="" alt=""></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('JS_view.qrcode')

@endsection