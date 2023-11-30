@extends('layout')
@section('content')

<style>
     .biensoxe{
        border: 5px solid; 
        text-align: center;
        border-color:#0974c9;
        color: #02b138f2;
        font-weight: bold;  

     }
</style>
<link rel="stylesheet" type="text/css" href="">
    <main>
        <div style="margin-top: 20px;"></div>
        
        <div class="container">
            <div class="row">
                @if(count($chuyenxe)==0)
                <br>
                <i><h4 style="color:red; border: 2px solid;">Xin Lỗi !! Tuyến xe này hôm nay đã hết Chuyến, Vui Lòng Tìm Chuyến Xe Khác, Cảm Ơn!</h4></i>
                @else
                  @foreach($chuyenxe as $chuyen)         
                  <div class="col-md-4 ftco-animate">
                    <div class="project-wrap">
                        <div class="img">
                            <img src="/images/anhxe/{{$chuyen->hinhxe}}" alt=""  style="width: inherit">
                            <span class="price">{{number_format($chuyen->dongia)}} VND</span>
                        </div>
                        <div class="text p-4">
                            <h3><a href="#">{{$chuyen->diemdi}} - {{$chuyen->diemden}}</a></h3>
                            <h3 class="fa fa-clock-o">&nbsp;<b> Giờ đi:</b> {{substr($chuyen->giodi,0,5)}}</h3>
                            <h3 class="fa fa-clock-o">&nbsp; <b>Ngày đi:</b>{{date('d-m-Y', strtotime($chuyen->ngaydi))}}</h3>
                            <h3 class="fa fa-road"> <b> Nơi xuất bến:</b>{{$chuyen->noixuatben}}</h3>
                            <ul>
                               <a href=""><li><span class="fa fa-bed">
                                @if($chuyen->soghe <= 0)
                                    ({{'HẾT VÉ'}})
                                 @else
                                 (Còn {{$chuyen->soghe}} ghế trống )
                                 @endif</span></li></a>
                            </ul>
                            <p class="biensoxe">Biển số : {{$chuyen->bienso}}</p>
                            {{-- <a href=""><button class="days">Xem chi tiết</button></a> --}}
                            @if(session()->has('data'))
                            @if($chuyen->soghe > 0)
                            <a href="{{route('datve',$chuyen->idchuyenxe)}}"><button class="days" style="margin-left: 38%; font-size:20px;">Đặt vé</button></a>
                            @else
                            <h3 style="text-align: center; color:#607d8b;">Đã hết vé</h3>
                             @endif
                             @else
                             <a href="{{URL::to('dangnhap')}}"  class="active" ui-toggle-class="" 
                                onclick="return confirm('Bạn phải đăng nhập để đặt vé')"><button class="days" style="margin-left: 38%; font-size:20px;">Đặt vé</button></a>
                          @endif
                        </div>
                    </div>
                </div>
                    @endforeach       
                    @endif  
                            <div class="col-lg-3" style="margin-left: auto;">
                                <div class="sidebar-news">
                                    <div class="items">
                                        <h3>Tìm chuyến xe</h3>
                                        <form action="{{route('timkiemchuyenxe')}}" method="get">
                                                 <div class="dropdown" >
                                  
                                       <select class="form-control" id="diemdi" name="diemdi" class="dropdown-select" >
                                        <option >Chọn điểm khởi hành</option>
                                           @foreach($diemkhoihanh as $tuyen)
                                                <option value="{{$tuyen->diemdi}}">{{$tuyen->diemdi}}</option>     
                                            @endforeach
                                        </select>                           
                                   </div>                           
                                    <div class="dropdown" >                                  
                                       <select class="form-control" id="diemden" name="diemden" class="dropdown-select" >
                                        <option >Chọn điểm đến</option>
                                           @foreach($diemden as $tuyen)
                                                <option value="{{$tuyen->diemden}}">{{$tuyen->diemden}}</option>             
                                            @endforeach
                                        </select>                            
                                    </div>         
                                            <div>  
                                             <input class="form-control"  id="ngaydi" name="ngaydi" type="text" style="width: 230px"  data-date-format="yyyy-mm-dd" value="<?php echo date("Y-m-d");?>" >
                                         </div>
                                              <button class="btn btn-primary" style="background-color: #f15d30;" type="submit">Tìm chuyến xe</button>
                                        </form>
                                    </div>
                                    <div class="items">
                                        <img width="100%" src="https://static.vexere.com/production/banners/330/banner-home.png" alt="">
                                    </div>
                                    <div class="items">
                                        <h3>Các điểm khởi hành</h3>
                                        <ul>
                                            @foreach($diemkhoihanh as $diem)
                                            <li>
                                                <a href="">{{$diem->diemdi}}</a>
                                            </li>
                                            @endforeach                                           
                                        </ul>
                                    </div>
                                </div>                        
                    </div>   
    </main>
     <script>
$(function () {
    'use strict';
    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

    var checkin = $('#ngaydi').datepicker({
        onRender: function (date) {
            return date.valueOf() < now.valueOf() ? 'disabled' : '';

        }
    }).on('changeDate', function (ev) {
        if (ev.date.valueOf() > checkout.date.valueOf()) {
            var newDate = new Date(ev.date)
            newDate.setDate(newDate.getDate() + 1);
        }
        checkin.hide();
    }).data('datepicker');
   
});
     
</script>    
@endsection