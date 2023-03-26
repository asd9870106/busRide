<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>busServcie</title>
        <link rel="stylesheet" href="{{asset('/css/app.css')}}">
        @vite(['resources/js/app.js'])
      </head>
      <body>
        {{-- <h3>取得憑證資料:</h3> --}}
        <div id="accesstoken" class="align-text-bottom" hidden>        
        </div>
    
        {{-- <h3>api 資料:</h3> --}}
        <div id="apireponse" class="align-text-bottom" hidden>        
        </div>
        <div class="container-fluid py-3">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="flex-grow-1">
                        <h1 class="text-center" id="bus_name">公車站牌</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid py-3">
            <div class="row justify-content-center">
                <div class="table-responsive">
                    <table class="table">
                        <h5 class="text-center">預計到站時間</h3>
                        <!-- <thead class="text-center">
                            <tr>
                                <th>路線名稱</th>
                                <th>剩餘時間</th>
                                <th>路線名稱</th>
                                <th>剩餘時間</th>
                            </tr>
                        </thead> -->
                        <tbody class="text-center">
                            <tr class="col-item">
                                <td>路線名稱</td>
                                <td>剩餘時間</td>
                                <td>路線名稱</td>
                                <td>剩餘時間</td>
                            </tr>
                        </tbody>
                        <tbody class="text-center">
                            <tr class="col-item">
                                <td>路線名稱</td>
                                <td>剩餘時間</td>
                                <td>路線名稱</td>
                                <td>剩餘時間</td>
                            </tr>
                        </tbody>
                        <tbody class="text-center">
                            <tr class="col-item">
                                <td>路線名稱</td>
                                <td>剩餘時間</td>
                                <td>路線名稱</td>
                                <td>剩餘時間</td>
                            </tr>
                        </tbody>
                        <tbody class="text-center">
                            <tr class="col-item">
                                <td>路線名稱</td>
                                <td>剩餘時間</td>
                                <td>路線名稱</td>
                                <td>剩餘時間</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <form id="Form_ride_info" autocomplete="off">
                <div class="row">
                    <h5 class="text-center">乘車資訊填寫</h3>
                </div>
                <div class="row">
                    <div class="col-md-2 py-3">
                        <span class="text-danger">*</span>
                        <span>勾選乘車路線</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <div class="custom-control custom-control-inline custom-checkbox">
                            <input type="checkbox" class="custom-control-input"
                            id="rideInfo_bus_checkbox_1" name="rideInfo_checkbox_type[]">
                            <label for="rideInfo_bus_checkbox_1"><span class="bustext1"></span></label>
                        </div>
                        <div class="custom-control custom-control-inline custom-checkbox">
                            <input type="checkbox" class="custom-control-input"
                            id="rideInfo_bus_checkbox_2" name="rideInfo_checkbox_type[]">
                            <label for="rideInfo_bus_checkbox_2"><span class="bustext2"></span></label>
                        </div>
                        <div class="custom-control custom-control-inline custom-checkbox">
                            <input type="checkbox" class="custom-control-input"
                            id="rideInfo_bus_checkbox_3" name="rideInfo_checkbox_type[]">
                            <label for="rideInfo_bus_checkbox_3"><span class="bustext3"></span></label>
                        </div>
                        <div class="custom-control custom-control-inline custom-checkbox">
                            <input type="checkbox" class="custom-control-input"
                            id="rideInfo_bus_checkbox_4" name="rideInfo_checkbox_type[]">
                            <label for="rideInfo_bus_checkbox_4"><span class="bustext4"></span></label>
                        </div>
                        <div class="custom-control custom-control-inline custom-checkbox">
                            <input type="checkbox" class="custom-control-input"
                            id="rideInfo_bus_checkbox_5" name="rideInfo_checkbox_type[]">
                            <label for="rideInfo_bus_checkbox_5"><span class="bustext5"></span></label>
                        </div>
                        <div class="custom-control custom-control-inline custom-checkbox">
                            <input type="checkbox" class="custom-control-input"
                            id="rideInfo_bus_checkbox_6" name="rideInfo_checkbox_type[]">
                            <label for="rideInfo_bus_checkbox_6"><span class="bustext6"></span></label>
                        </div>
                        <div class="custom-control custom-control-inline custom-checkbox">
                            <input type="checkbox" class="custom-control-input"
                            id="rideInfo_bus_checkbox_7" name="rideInfo_checkbox_type[]">
                            <label for="rideInfo_bus_checkbox_7"><span class="bustext7"></span></label>
                        </div>
                        <div class="custom-control custom-control-inline custom-checkbox">
                            <input type="checkbox" class="custom-control-input"
                            id="rideInfo_bus_checkbox_8" name="rideInfo_checkbox_type[]">
                            <label for="rideInfo_bus_checkbox_8"><span class="bustext8"></span></label>
                        </div>
                        <div class="custom-control custom-control-inline custom-checkbox">
                            <input type="checkbox" class="custom-control-input"
                            id="rideInfo_bus_checkbox_9" name="rideInfo_checkbox_type[]">
                            <label for="rideInfo_bus_checkbox_9"><span class="bustext9"></span></label>
                        </div>
                        <div class="custom-control custom-control-inline custom-checkbox">
                            <input type="checkbox" class="custom-control-input"
                            id="rideInfo_bus_checkbox_10" name="rideInfo_checkbox_type[]">
                            <label for="rideInfo_bus_checkbox_10"><span class="bustext10"></span></label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 py-3">
                        <span class="text-danger">*</span>
                        <span>勾選乘車需求</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <div class="custom-control custom-control-inline custom-checkbox">
                            <input type="checkbox" class="custom-control-input"
                            id="rideInfo_type_checkbox_1" name="rideInfo_checkbox_type[]">
                            <label for="rideInfo_type_checkbox_1">無障礙</label>
                        </div>
                        <div class="custom-control custom-control-inline custom-checkbox">
                            <input type="checkbox" class="custom-control-input"
                            id="rideInfo_type_checkbox_2" name="rideInfo_checkbox_type[]">
                            <label for="rideInfo_type_checkbox_2">身心障礙</label>
                        </div>
                        <div class="custom-control custom-control-inline custom-checkbox">
                            <input type="checkbox" class="custom-control-input"
                            id="rideInfo_type_checkbox_3" name="rideInfo_checkbox_type[]">
                            <label for="rideInfo_type_checkbox_3">孕婦</label>
                        </div>
                        <div class="custom-control custom-control-inline custom-checkbox">
                            <input type="checkbox" class="custom-control-input"
                            id="rideInfo_type_checkbox_4" name="rideInfo_checkbox_type[]">
                            <label for="rideInfo_type_checkbox_4">年長者</label>
                        </div>
                        <div class="custom-control custom-control-inline custom-checkbox">
                            <input type="checkbox" class="custom-control-input"
                            id="rideInfo_type_checkbox_5" name="rideInfo_checkbox_type[]">
                            <label for="rideInfo_type_checkbox_5">幼童</label>
                        </div>
                        <div class="custom-control custom-control-inline custom-checkbox">
                            <input type="checkbox" class="custom-control-input"
                            id="rideInfo_type_checkbox_6" name="rideInfo_checkbox_type[]">
                            <label for="rideInfo_type_checkbox_6">無</label>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row text-center">
                    <div class="col-12">
                        <button type="button" class="btn btn-primary" onclick="formSumbit()">送出</button>
                    </div>
                </div>
            </form>
        </div>
        @include('JS_view.station')
      </body>
</html>
