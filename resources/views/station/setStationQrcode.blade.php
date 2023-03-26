@extends('default')

@section('header')
    @include('layouts.header')
@endsection


@section('contents')
<div class="container-fluid">
    <div class="grid m-3">
        <div id="Div_foundation_list">
            {{-- 搜尋欄位 --}}
            @include('station._FoundationManagementListSearchBar')
            @yield('test')
            {{-- 基金會列表 --}}
            {{-- <div class="row">
                <div class="col-12 table-responsive" data-aos="fade-up">
                    <table id="ReviewData_table" class="table table-bordered text-center">
                        <thead class="thead-light">
                            <tr>
                                <th style="width:50%;">基金會代碼</th>
                                <th style="width:50%;">基金會名稱</th>
                            </tr>
                        </thead>
                        <tbody id="Tbody_foundation_list" class="tableShade">
                            <tr>
                                <td colspan="5"><h3 class="p-3">⚠ 查無基金會資訊</h3></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div> --}}
            {{-- 選擇頁數 --}}
            <nav id="paginationArea" aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li id="previousIcon" class="page-item d-none">
                        <a id="Previous-Page" class="page-link" aria-label="Previous" onclick="previousPage()">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <li id="firstPage" class="page-item d-none">
                        <a id="First-Page" class="page-link" aria-label="First" onclick="goPage(1)">
                        <span>1</span>
                        </a>
                    </li>
                    <li id="frontDot" class="page-item d-none"><a class="page-link"><span>⋅⋅⋅</span></a></li>
                    <div id="Pages" class="d-flex flex-row"></div>
                    <li id="backDot" class="page-item d-none"><a class="page-link"><span>⋅⋅⋅</span></a></li>
                    <li id="lastPage" class="page-item d-none">
                        <a id="Last-Page" class="page-link" aria-label="Last" onclick="toLastPage()">
                        <span id="lastPageText"></span>
                        </a>
                    </li>
                    <li id="nextIcon" class="page-item d-none">
                        <a id="Next-Page" class="page-link" aria-label="Next" onclick="nextPage()">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>        
        </div>
    </div>
</div>
<script> 

</script>
@endsection