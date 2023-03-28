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
                        <label class="formtext" for="number m-3">公車路線:</label>
                        <input type="text" name="number" id="number" class="number">
                    </div>
                    <div class="forminput m-3">
                        <label class="formtext" for="station">站牌:</label>
                        <input type="text" name="station" id="station" class="station">
                    </div>
                    <button class="formButton" type="submit">搜尋</button>
                </form>
            </div>
            @yield('test')
        </div>
    </div>
</div>
<script> 

</script>
@endsection