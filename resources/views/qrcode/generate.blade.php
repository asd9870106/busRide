@extends('station.setStationQrcode')

@section('test')
    <br>
    @if(isset($station) && isset($qrCode))
        <p>QR Code for {{ $station }}:</p>
        {!! $qrCode !!}
    @endif

@endsection
