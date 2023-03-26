<div class="row justify-content-center">
    <form action="{{ route('get_station_qrcode') }}" method="post">
        @csrf
        <label for="station">Station:</label>
        <input type="text" name="station" id="station" class="station">
        <button type="submit">Create QR Code</button>
    </form>
    {{-- <div class="col-md-10">
        <div class="flex-grow-1">
            <h1 class="text-center" id="bus_name"></h1>
        </div>
    </div>
    <div class="d-flex align-items-center text-nowrap p-2">
        <label class="mb-0 mr-2" for="Input_keyword">關鍵字查詢</label>
        <div class="input-group m-2">
            <input type="text" id="Input_keyword"  class="form-control"
                aria-describedby="key-word-addon" value=""
                placeholder="站牌名稱或代碼">
        </div>
    </div>
    <div class="d-flex align-items-center text-nowrap p-2">
        <label class="mb-0 mr-2" for="Select_submit">站牌狀態</label>
        <select id="Select_submit" class="form-control m-2">
            <option value="99">全部</option>
            <option value="1" >正常</option>
        </select>
    </div>
    <button class="btn btn-primary m-2" onclick="">
        <i class="fas fa-search-plus"> 篩選 </i>
    </button>
    <button  class="btn btn-primary m-2" data-tippy-content="重置篩選條件" onclick="i">
        <i class="fa fa-undo"> 重置</i>
    </button> --}}
</div>
{{-- <div class="row">
    <div class="col-12 text-right">
        <button type="button" class="btn btn-primary btn-lg m-2 mb-3"
            data-tippy-content="新增站牌" onclick="">
            <i class="fa fa-plus"></i>
        </button>
    </div>
</div> --}}

