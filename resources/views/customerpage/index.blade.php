@extends('layout')
@section('content')

@if(session('thanhcong'))
    <script type="text/javascript">
    alert("Bạn đã đăng nhập thành công ");
    </script>
@endif
<div class="row">
    <div class="col-md-12">
        <div class="ftco-search d-flex justify-content-center">
            <div class="row">
                <div class="col-md-12 nav-link-wrap">
                    <div class="nav nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active mr-md-1" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1" role="tab" aria-controls="v-pills-1" aria-selected="true">Tìm chuyến xe</a>
                    </div>
                </div>
                <div class="col-md-12 tab-wrap">
                    
                    <div class="tab-content" id="v-pills-tabContent">

                        <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-nextgen-tab">
                            <form action="{{route('timkiemchuyenxe')}}" class="search-property-1" method="get">
                           <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="row no-gutters">                                     
                                <div class="col-md d-flex">
                                    <div class="form-group p-4 diemdi">
                                        <label for="#">Điểm đi</label>
                                        <span class="input-group-addon"><i class="fa fa-bus"></i></span>
                                        <div class="form-field">
                                            <div class="select-wrap">
                                             <div class="icon"><span class="fa fa-chevron-down"></span></div>                                     
                                                <select name="diemdi" id="diemdi" class="form-control txtnoidi">
                                                 @foreach($diemdi as $di)
                                                    <option value="{{$di->diemdi}}">{{$di->diemdi}}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md d-flex diemden">
                                    <div class="form-group p-4">
                                        <label for="#">Điểm đến</label>
                                        <span class="input-group-addon"><i class="fa fa-bus"></i></span>
                                        <div class="form-field">
                                            <div class="select-wrap">
                                                <div class="icon"><span class="fa fa-chevron-down"></span></div>
                                                <select name="diemden" id="diemden" class="form-control txtnoiden">
                                                    @foreach($diemden as $den)
                                                    <option value="{{$den->diemden}}">{{$den->diemden}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md d-flex ngaydi">
                                    <div class="form-group p-4">
                                        <label for="#">Ngày đi</label>
                                        <div class="form-field">
                                            <div class="icon"><span class="fa fa-calendar"></span></div>
                                            <input type="date" id="ngaydi" name="ngaydi"  class="form-control txtngaydi" placeholder="Check Out Date" id="txtdate" value="">
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="col-md d-flex">
                                    <div class="form-group d-flex w-100 border-0">
                                        <div class="form-field w-100 align-items-center d-flex">
                                            <button type="submit" value="Search" id="timchuyendimain" class="align-self-stretch form-control btn btn-primary">Tìm</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<section class="ftco-section ftco-no-pb ftco-no-pt">
    <div class="container">
<section class="ftco-section img ftco-select-destination" style="background-image: url(frontend/images/bg_3.jpg);">
    <div class="container">
        <div class="row justify-content-center pb-4">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <span class="subheading">An toàn là trên hết</span>
                <h2 class="mb-4">Hãy chọn tuyến xe cho bạn</h2>
            </div>
        </div>
    </div>
    <div class="container container-2">
        <div class="row">
            <div class="col-md-12">
                <div class="carousel-destination owl-carousel ftco-animate">
                    @foreach($tuyenxe as $tuyen)
                    <div class="item">                    
                        <div class="project-destination">
                            <a href="{{URL::to('tuyenxe/'.$tuyen->idtuyenxe)}}" class="img" style="background-image: url(images/anhtuyenxe/{{$tuyen->hinhanh}});">
                                <div class="text">
                                    <h3>{{$tuyen->diemdi}} - {{$tuyen->diemden}}</h3>

                                    <span>{{number_format($tuyen->dongia)}} VNĐ</span>
                                </div>                       
                            </a>
                        </div>       
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@foreach($diemdi as $di)
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center pb-4">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <span class="subheading">Điểm khởi hành</span>
                <h2 class="mb-4">{{$di->diemdi}}</h2>
            </div>
        </div>

        <div class="row">
            @foreach($tuyenxe as $tuyen)
            @if($di->diemdi == $tuyen->diemdi)
            <div class="col-md-4 ftco-animate">
                <div class="project-wrap">
                    <a href="{{URL::to('tuyenxe/'.$tuyen->idtuyenxe)}}" class="img" style="background-image: url(images/anhtuyenxe/{{$tuyen->hinhanh}});">
                        <span class="price">{{number_format($tuyen->dongia)}} VND</span>
                    </a>
                    <div class="text p-4">
                        <span class="days">8 Days Tour</span>
                        <h3><a href="{{URL::to('tuyenxe/'.$tuyen->idtuyenxe)}}">{{$tuyen->diemdi}} - {{$tuyen->diemden}}</a></h3>
                        <p class="location"><span class="fa fa-map-marker"></span> {{$tuyen->diemden}}</p>
                        <ul>
                            <li><span class="flaticon-mountains"></span>Near Mountain</li>
                        </ul>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</section>
@endforeach





<section class="ftco-section testimony-section bg-bottom" style="background-image: url(frontend/images/bg_1.jpg);">
    <div class="overlay"></div>
    <div class="container">
        <div class="row justify-content-center pb-4">
            <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
                <span class="subheading">Khách Hàng</span>
                <h2 class="mb-4">Đánh giá dịch vụ</h2>
            </div>
        </div>
        <div class="row ftco-animate">
            <div class="col-md-12">
                <div class="carousel-testimony owl-carousel">
                    <div class="item">
                        <div class="testimony-wrap py-4">
                            <div class="text">
                                <p class="star">
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                </p>
                                <p class="mb-4">Phục vụ tốt, chất lượng tuyệt vợi, dịch vụ đáng tin cây của mọi người.</p>
                                <div class="d-flex align-items-center">
                                    <div class="user-img" style="background-image: url(frontend/images/person_1.jpg)"></div>
                                    <div class="pl-3">
                                        <p class="name">Roger Scott</p>
                                        <span class="position">Marketing Manager</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimony-wrap py-4">
                            <div class="text">
                                <p class="star">
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                </p>
                                <p class="mb-4">Tốt ! Phục vụ tốt, chất lượng tuyệt vợi, dịch vụ đáng tin cây của mọi người</p>
                                <div class="d-flex align-items-center">
                                    <div class="user-img" style="background-image: url(frontend/images/person_2.jpg)"></div>
                                    <div class="pl-3">
                                        <p class="name">Roger Scott</p>
                                        <span class="position">Marketing Manager</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                
                    <div class="item">
                        <div class="testimony-wrap py-4">
                            <div class="text">
                                <p class="star">
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                </p>
                                <p class="mb-4">Dịch vụ quá tuyệt vời, nhân viên nhiệt tình, phục vụ nhanh chóng.</p>
                                <div class="d-flex align-items-center">
                                    <div class="user-img" style="background-image: url(frontend/images/person_2.jpg)"></div>
                                    <div class="pl-3">
                                        <p class="name">Roger Scott</p>
                                        <span class="position">Marketing Manager</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection