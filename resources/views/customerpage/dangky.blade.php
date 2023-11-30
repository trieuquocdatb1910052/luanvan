{{-- @extends('layout')
@section('content') --}}
@include('script_cus')
@include('head_cus')
<style>
        *{
    padding: 0px;
    margin: 0px;
    font-family: sans-serif;
    box-sizing: border-box;
}
header{
    background-color: #0c76da;
    min-height: 70px;
    padding: 15px;
}
main{
    background-color: #dddddd;
    min-height: 300px;
    padding: 7.5px 15px;
}
footer{
    /* background-color:gray;*/
    min-height: 70px;
    padding: 15px;
}
.container{
    width: 100%;
    max-width: 1200px;
    margin-left: auto;
    margin-right: auto;
    
}
.login-form{
    width: 100%;
    max-width: 400px;
    margin: 20px auto;
    background-color: #ffffff;
    padding: 15px;
    border: 2px dotted #cccccc;
    border-radius: 10px;
}
h1{
    color: #f15d30;
    font-size: 20px;
    margin-bottom: 30px;
    text-align: center;
}
.input-box{
    margin-bottom: 10px;
}
.input-box input{
    padding: 7.5px 15px;
    width: 100%;
    border: 1px solid #cccccc;
    outline: none;
}
.btn-box{
    text-align: right;
    margin-top: 30px;
}
.btn-box button{
    padding: 7.5px 15px;
    border-radius: 2px;
    background-color: #f15d30;
    color: #ffffff;
    border: none;
    outline: none;
}
</style>
<!DOCTYPE html>
<html>
<head>
    <title>Life - Vé xe cho bạn</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/login.css" rel="stylesheet" type="text/css"/>
</head>
<body>
    <header>
        <div class="container" style="font-weight: bold;">
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
                            <li class="nav-item"><a href="{{URL::to('dangky')}}" class="nav-link">Đăng ký</a></li>
                            <li class="nav-item"><a href="{{URL::to('dangnhap')}}" class="nav-link">Đăng nhập</a></li>
                            <li class="nav-item"><a href="{{URL::to('lienhe')}}" class="nav-link">Liên hệ</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <main>
        <div class="container">
             
        <div class="login-form">
            <h1>Đăng ký tài khoản khách hàng</h1>
            <form action="{{URL::to('dangky')}}" method="post">
                 <input type="hidden" name="_token" value="{{csrf_token()}}" />
                <label for="">Tên tài khoản</label>
                <div class="input-box">
                    <input type="text" name="tentaikhoan" placeholder="Nhập tên tài khoản" value="{{old('tentaikhoan')}}"> 
                    <span class="error-message">{{ $errors->first('tentaikhoan') }}</span>     
                </div>
                <label for="">Mật khẩu</label>
                <div class="input-box">                 
                    <input type="password" name="password" placeholder="Nhập mật khẩu">
                    <span class="error-message">{{ $errors->first('password') }}</span>
                </div>
                <label for="">Xác nhận mật khẩu</label>
                <div class="input-box">
                    <input type="password" name="re_password" placeholder="Nhập lại mật khẩu">
                    <span class="error-message">{{ $errors->first('re_password') }}</span>
                </div>
                <label for="">Số điện thoại</label>
                <div class="input-box">
                    <input type="text" name="sdt" placeholder="Nhập số điện thoại">
                    <span class="error-message">{{ $errors->first('sdt') }}</span>
                </div>
                <label for="">Email</label>
                <div class="input-box">
                    <input type="text" name="email" placeholder="Nhập email" value="{{old('email')}}">
                    <span class="error-message">{{ $errors->first('email') }}</span>
                </div>
                <label for="" class="text-uppercase">Họ và tên</label>
                <div class="input-box">
                    <input type="text" name="hoten" class="form-control" placeholder="Nhập họ và tên" value="{{old('hoten')}}">               
                    <span class="error-message">{{ $errors->first('hoten') }}</span>
                </div>
                <div class="">
                     Nam: <input type="radio" name="gioitinh" value="1" checked/>
                     &emsp;&emsp;
                     Nữ: <input type="radio" name="gioitinh" value="0" />
                </div>
                <br>
                <label for="">Địa chỉ</label>
                <div class="input-box">
                    <input type="text" name="diachi" placeholder="Nhập địa chỉ"  value="{{old('diachi')}}">
                    <span class="error-message">{{ $errors->first('diachi') }}</span>
                </div>
                @if(session('thongbao'))
                <div class="alert alert-success text-center">
                    {{session('thongbao')}}
                </div>
                @endif
                <div class="btn-box">
                    <a href="{{URL::to('dangnhap')}}" style="margin-right: 30px;">Đã có tài khoản</a>
                    <button type="submit">
                        Đăng ký
                    </button>
                </div>
            </form>
        </div>
        </div>
    </main>
    <footer>
        <div class="container">
        Triệu Quốc Đạt
        <br>
        DI19V7A2
        <br>
        Can Tho University
        </div>
    </footer>
</body>
</html>
{{-- @endsection --}}

<style type="text/css">
    /* màu hiển thị lỗi*/
   .error-message { color: red; }
   @import url("//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css");
 /*.login-block{
     background: #DE6262;   fallback for old browsers 
 background: -webkit-linear-gradient(to bottom, #FFB88C, #DE6262);   Chrome 10-25, Safari 5.1-6 
 /*background: linear-gradient(to bottom, #FFB88C, #DE6262);*/
  /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
 /*float:left;
 width:100%;*/
    label{
        font-weight: bold;
        font-size: 16px;
        color:#000;
    }
 
 