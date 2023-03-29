@extends('station.setStationQrcode')

@section('test')
    <br>
    @if(isset($station) && isset($qrCode))
        <p class="formtext">QR Code for  :</p>
        {{-- {!! $qrCode !!} --}}
    @endif

@endsection
