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
                    <thead class="thead-light">
                        <tr>
                            <th style="width:15%">站牌</th>
                            <th style="width:35%">QR code</th>
                            <th style="width:15%">站牌</th>
                            <th style="width:35%">QR code</th>
                        </tr>
                    </thead>
                    <tbody class="stationQrcode">
                        <tr class="">
                            <td class="stopName">富貴森林公園</td>
                            <td id="qrcode"><div id="qrcode"></div></td>
                            {{-- <td class="stopName">富貴森林公園</td>
                            <td class=" qrcode"><div id="qrcodes"></div></td> --}}
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('JS_view.qrcode')

@endsection