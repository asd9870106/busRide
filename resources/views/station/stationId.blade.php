@extends('default')

{{-- @section('header')
    @include('layouts.header')
@endsection --}}

@section('contents')

    <div class="container-fluid py-1">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="flex-grow-1">
                    <h1 class="text-center" id="bus_name"></h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container py-3">
        <div class="row justify-content-center">
            <span class="time" id="timer">更新倒數 15 秒</span>
            <div class="table-responsive shadow">
                <table class="table">
                    <thead class="text-center">
                        <tr>
                            <th>路線名稱</th>
                            <th>到站時間</th>
                            {{-- <th>路線名稱</th>
                            <th>到站時間</th> --}}
                        </tr>
                    </thead>
                    <tbody class="tableClone text-center ">
                        @include('clone_view.tableBusStatus')
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="container">
        <form id="Form_ride_info">
            <div class="row">
                <h5 class="text-center">乘車資訊填寫</h3>
            </div>
            <div class="row">
                <div class="col-8 rifoView">
                    <span class="text-danger">*</span>
                    <span>勾選乘車路線</span>
                </div>
                <div class="col-4 text-end rifoView">
                    {{-- <button type="button" class="rifoButton" data-toggle="modal" data-target="#exampleModal">
                        預約資訊
                      </button> --}}
                    <!-- Button trigger modal -->
                    <button type="button" class="rifoButton" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="rifoModel()">
                        預約資訊
                    </button>
                    {{-- <button type="button" id="openModalButton" class="rifoButton" onclick="rifoModel()">預約資訊</button> --}}
                </div>
                @include('station.modal.showRifo')
            </div>
            <div class="row">
                <div class="col-md-10 busNumber p-1" id="clonetest">
                    @include('clone_view.busInfoClone')
                </div>
            </div>
            <div>
                <span class="text-danger">*</span>
                <span>勾選乘車需求</span>
            </div>
            <div class="row">
                <div class="col-md-10 rideInfo p-1">
                    <div class="custom-control custom-control-inline custom-checkbox">
                        <input type="checkbox" class="custom-control-input" onclick="setcheckbox(this)"
                        id="rideInfo_type_checkbox_0" name="rideInfo_checkbox_type[]" value="1">
                        <label for="rideInfo_type_checkbox_0">無障礙</label>
                    </div>
                    <div class="custom-control custom-control-inline custom-checkbox">
                        <input type="checkbox" class="custom-control-input" onclick="setcheckbox(this)"
                        id="rideInfo_type_checkbox_1" name="rideInfo_checkbox_type[]" value="2">
                        <label for="rideInfo_type_checkbox_1">孕婦</label>
                    </div>
                    <div class="custom-control custom-control-inline custom-checkbox">
                        <input type="checkbox" class="custom-control-input" onclick="setcheckbox(this)"
                        id="rideInfo_type_checkbox_2" name="rideInfo_checkbox_type[]" value="3">
                        <label for="rideInfo_type_checkbox_2">年長者</label>
                    </div>
                    <div class="custom-control custom-control-inline custom-checkbox">
                        <input type="checkbox" class="custom-control-input" onclick="setcheckbox(this)"
                        id="rideInfo_type_checkbox_3" name="rideInfo_checkbox_type[]" value="4">
                        <label for="rideInfo_type_checkbox_3">行動不便</label>
                    </div>
                    <div class="custom-control custom-control-inline custom-checkbox">
                        <input type="checkbox" class="custom-control-input" onclick="setcheckbox(this)"
                        id="rideInfo_type_checkbox_4" name="rideInfo_checkbox_type[]" value="5">
                        <label for="rideInfo_type_checkbox_4">身心障礙</label>
                    </div>
                    <div class="custom-control custom-control-inline custom-checkbox">
                        <input type="checkbox" class="custom-control-input" onclick="setcheckbox(this)"
                        id="rideInfo_type_checkbox_5" name="rideInfo_checkbox_type[]" value="6">
                        <label for="rideInfo_type_checkbox_5">幼童</label>
                    </div>
                    <div class="custom-control custom-control-inline custom-checkbox" >
                        <input type="checkbox" class="custom-control-input" onclick="resetCheckbox(this)"
                        id="rideInfo_type_checkbox_99" name="rideInfo_checkbox_type[]" value="7">
                        <label for="rideInfo_type_checkbox_99">無</label>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row text-center">
                <div class="col-12">
                    <button type="button" class="btn btn-primary" onclick="onFormSubmit()">送出</button>
                </div>
            </div>
        </form>
    </div>
    @include('JS_view.stationId')
@endsection