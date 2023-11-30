@extends('layout')
@section('content')
<style>
  tr{transition: all .25 ease-in-out}
  tr:hover {background-color: #EEE;cursor: pointer;}

  .nutxoa{
    background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  }

</style>


<section class="login-block">

    <div class="row">
        <div class="col-md-12 login-sec">
            <h2 class="text-center">Thông tin người đặt</h2>
           <!-- 
                        @if(session('thanhcong'))
                            
                              <div class="alert alert-success">{{Session::get('thanhcong')}}</div>
                            
                        @endif  -->
 <form class="login-form" id="loginForm" method="post" action="{{route('thanhtoan',$ve->idve)}}">
  <input style="color:white" type="hidden" name="_token" value="{{csrf_token()}}" />
   @if(session()->has('data'))
   <div class="col-md-12" >     
    <table class="table thead-dark" style="text-align: center" >  
      <tr>  @if ( strlen(strval($ve->idve))==2)
        <td></td>
        <td>Mã vé: <br>{{"0".$ve->idve.$t}}</td>
        @elseif( strlen(strval($ve->idve))==1)
        <td></td>
        <td>Mã vé: <br>{{"00".$ve->idve.$t}}</td>
        
        @elseif( strlen(strval($ve->idve))==3)
        <td></td>
        <td>Mã vé: <br>{{$ve->idve.$t}}</td>
       @endif
      </tr>
      <tr>         <td></td>
        <td>Chuyến: {{$ve->diemdi}}-{{$ve->diemden}}</td>    
      </tr>
      <tr>        <td></td>
        <td>Thời gian: {{$ve->ngaydi}}-{{$ve->ngayden}}<br>Khởi hành: {{$ve->giodi}}</td>
      </tr>
      <tr>
        <td>Hình thức thanh toán:</td>
        <td><input type="radio" name="trangthai" value="1">Thanh toán bằng momo</td>
        <td><input type="radio" name="trangthai" value="1">Thanh toán bằng thẻ ngân hàng</td>
      </tr>
      <tr>
        <td></td>
        <td><input type="submit" class="btn btn-primary" value="Xác nhận"></td>
        <td></td>
      </tr>
</table  >

</div>                
@endif
</form>
</section>
<style type="text/css">
   /* màu hiển thị lỗi*/
   .error-message { color: red; }
  @import url("//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css");
*/
.banner-sec{background:url(https://static.pexels.com/photos/33972/pexels-photo.jpg)  no-repeat left bottom; background-size:cover; min-height:500px; border-radius: 0 10px 10px 0; padding:0;}
.khung{background:#fff; border-radius: 10px; box-shadow:15px 20px 0px rgba(0,0,0,0.1);}
.carousel-inner{border-radius:0 10px 10px 0;}
.carousel-caption{text-align:left; left:5%;}
.login-sec{padding: 0 30px; position:relative;}
.login-sec .copy-text{position:absolute; width:80%; bottom:20px; font-size:13px; text-align:center;}
.login-sec .copy-text i{color:#FEB58A;}
.login-sec .copy-text a{color:#E36262;}
.login-sec h2{margin-bottom:30px; font-weight:800; font-size:30px; color: #DE6262;}
.login-sec h2:after{content:" "; width:100px; height:5px; background:#FEB58A; display:block; margin-top:20px; border-radius:3px; margin-left:auto;margin-right:auto}
.btn-login{background: #DE6262; color:#fff; font-weight:600;}
.banner-text{width:70%; position:absolute; bottom:40px; padding-left:20px;}
.banner-text h2{color:#fff; font-weight:600;}
.banner-text h2:after{content:" "; width:100px; height:5px; background:#FFF; display:block; margin-top:20px; border-radius:3px;}
.banner-text p{color:#fff;}

</style>



@endsection
