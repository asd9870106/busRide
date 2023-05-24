@extends('default')

@section('header')
    @include('layouts.stationHeader')
@endsection

@section('contents')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-6 mb-4">
                    <a href="{{ route('set_bus_qrcode') }}">
                        <div class="card square-card">
                            <div class="card-body text-center">
                                <i class="fa fa-search fa-lg mb-2"></i>
                                <div class="search-text">
                                    搜尋站牌
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 mb-4">
                    <a href="{{ route('set_bus_qrcode') }}">
                        <div class="card square-card">
                            <div class="card-body text-center">
                                站牌查詢
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-12 mt-4">
            <div class="row">
                <div class="col-6">
                    <a href="{{ route('set_bus_qrcode') }}">
                        <div class="card square-card">
                            <div class="card-body text-center">
                                路線規劃
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6">
                    <a href="{{ route('set_bus_qrcode') }}">
                        <div class="card square-card">
                            <div class="card-body text-center">
                                路線規劃
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
