@extends('station.setBusQrcode')

@section('test')
    <br>
    @if(isset($route) && isset($qrCode))
        <p class="formtext">QR Code for {{ $route }} :</p>
        {!! $qrCode !!}
    @endif

@endsection
