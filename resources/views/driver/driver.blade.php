<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>driver view</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @vite(['resources/js/app.js'])
</head>
<body>
    <div class="wrap">
        <nav class="nav">
            <div class="container py-3">
                <div class="row">
                    <div class="col-8 top_text text-end">
                        <span class="m-5">
                            乘客預約資訊
                        </span>
                    </div>
                    <div class="col-4 bus_text text-end py-3">
                        <span>
                            路線 : <span class="bus_number"></span>
                        </span>
                        <div class="">
                            車牌 : <span class="bus_license_plate"></span>
                        </div>
                        <div class="time" id="timer">更新倒數 15 秒</div>

                    </div>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row mx-3">
                <div class="mx-3 auto-size-next">
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="arrow">下一站:</div>
                                </td>
                                <td>
                                    <input class="next_stop m-3" type="radio" id="next_stop">
                                </td>
                                <td>
                                    <div class="arrow"><span class="nextStop"></span></div>
                                </td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row mx-3 py-5">
                    {{-- <div class="col-md-10">
                        <div class="arrow">
                            <img class="m-5" src="{{asset('/photo/test2.jpg')}}" alt="博愛座">
                        </div>
                        <div class="arrow">
                            <img class="m-5" src="{{asset('/photo/test3.png')}}" alt="輪椅">
                        </div>
                    </div> --}}
                    <table class="mx-3">
                        <tbody>
                            <tr>
                                <td>
                                    <div class="image general d-none">
                                        <img class="m-3 busType" src="{{asset('/photo/test4.jpg')}}" alt="一般民眾">
                                    </div>
                                    <div class="image fraternity d-none">
                                        <img class="m-3 busType" src="{{asset('/photo/test2.jpg')}}" alt="博愛座">
                                    </div>
                                    <div class="image accessible d-none">
                                        <img class="m-3 busType" src="{{asset('/photo/test3.png')}}" alt="輪椅">
                                    </div>
                                </td>
                                <td>
                                </td>                              
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row mx-3 py-2">
                <div class="mx-3 text-break auto-size">
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    <input class="next_stop_1" type="radio" id="next_stop_1">
                                </td>
                                <td class="next_stop text-break">
                                    <label class="m-2" id="next_stop_1" for="next_stop_1" name="next_stop_1"><span class="nextStop1"></span></label>
                                </td>
                                <td class="next_stop text-break">
                                    <span class="m-5">⟶</span>
                                </td>
                                <td>
                                    <input class="next_stop_2" type="radio" id="next_stop_2">
                                </td>
                                <td class="next_stop text-break">
                                    <label class="m-2" id="next_stop_2" for="next_stop_2" name="next_stop_2"><span class="nextStop2"></span></label>
                                </td>
                                <td class="next_stop text-break">
                                    <span class="m-5">⟶</span>
                                </td>
                                <td>
                                    <input class="next_stop_3" type="radio" id="next_stop_3">
                                </td>
                                <td class="next_stop text-break">
                                    <label class="m-2" id="next_stop_3" for="next_stop_3" name="next_stop_3"><span class="nextStop3"></span></label>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    

    @include('JS_view.driver')
</body>
</html>