
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{URL::to('')}}">LIFE<span>Sự lựa chọn an toàn cho bạn</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="{{URL::to('')}}" class="nav-link">Trang chủ</a></li>
                <li class="nav-item"><a href="{{URL::to('gioithieu')}}" class="nav-link">Giới thiệu</a></li>
                {{-- {{dd(session('hoten'))}}  --}}
                @if(session()->has('data'))
                <li class="nav-item"><a style="color:#00ff0a; border-bottom: double;" href="{{URL::to('thongtinkh/'.session('data')['tentaikhoan'])}}" class="nav-link">Chào bạn: {{session('data')['tentaikhoan']}}</a></li>
                <li class="nav-item"><a href="{{URL::to('dangxuatKH')}}" class="nav-link">Đăng xuất</a></li>
                @elseif(session('hoten1'))
                <li class="nav-item"><a style="color:#00ff0a; border-bottom: double;" href="" class="nav-link">Chào bạn: {{session('hoten1')}}</a></li>
                <li class="nav-item"><a href="{{URL::to('dangxuatKH')}}" class="nav-link">Đăng xuất</a></li>
                @else
                <li class="nav-item"><a href="{{URL::to('dangky')}}" class="nav-link">Đăng ký</a></li>
                <li class="nav-item"><a href="{{URL::to('dangnhap')}}" class="nav-link">Đăng nhập</a></li>
                @endif
                <li class="nav-item"><a href="{{URL::to('lienhe')}}" class="nav-link">Liên hệ</a></li>
            </ul>
        </div>
    </div>
</nav>


<div class="hero-wrap js-fullheight" style="background-image: url('https://i.ytimg.com/vi/_MHWeC9gxLQ/maxresdefault.jpg');">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center" data-scrollax-parent="true">
            <div class="col-md-7 ftco-animate">
                {{-- <span class="subheading">Welcome to Pacific</span> --}}
                <h1 class="mb-4"><strong style="color:#f15d30">LIFE</strong>  Sự lựa chọn an toàn cho bạn</h1>
                {{-- <p class="caps">Di chuyển đến bất kỳ nơi nào trên thế giới, mà không cần đi vòng tròn</p> --}}
            </div>
            <a href="https://vimeo.com/45830194" class="icon-video popup-vimeo d-flex align-items-center justify-content-center mb-4">
                <span class="fa fa-play"></span>
            </a>
        </div>
    </div>
</div>