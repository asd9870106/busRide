<header>
    @include('layouts._HeaderTopper')
    <div class="container-fluid justify-content-start navbar-expand-lg">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <nav class="navbar navbar-light text-center px-0">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-center justify-content-lg-start" id="navbarNavDropdown">
                        <ul class="navbar-nav text-center">
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold" href="">首頁</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle font-weight-bold" href="#" id="navbarDropdownMenuLink"
                                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    站牌管理
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="{{ route('set_station_qrcode') }}">產生站牌 QR code</a>
                                    <a class="dropdown-item" href="{{ route('set_bus_qrcode') }}">產生公車 QR code</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle font-weight-bold" href="#" id="navbarDropdownMenuLink"
                                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    查詢
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="{{ route('search_nearby') }}">查詢附近站牌</a>
                                    <a class="dropdown-item" href="{{ route('search_destination') }}">目的地附近站牌</a>
                                </div>
                            </li>
                            {{-- <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle font-weight-bold" href="#" id="navbarDropdownMenuLink"
                                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    後臺管理
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item"
                                        href="">帳號管理</a>
                                    <a class="dropdown-item"
                                        href="">內部公告管理</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle font-weight-bold" href="#" id="navbarDropdownMenuLink"
                                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    活動管理
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="">活動管理</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold" href="">資訊檢索</a>
                            </li> --}}
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
