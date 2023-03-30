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
                <form action="{{ route('get_driver_qrcode') }}" method="post">
                    @csrf
                    <div class="forminput">
                        <label class="formtext m-3" for="route">公車路線:</label>
                        <input type="text" name="route" id="route" class="bus">
                    </div>
                    <div class="forminput">
                        <label class="formtext m-3" for="busName">公車車牌:</label>
                        <input type="text" name="busName" id="busName" class="bus">
                    </div>
                    <button class="formButton m-3" type="submit">搜尋</button>
                </form>
            </div>
            @yield('test') 
        </div>
    </div>
</div>
<script> 

</script>
@endsection