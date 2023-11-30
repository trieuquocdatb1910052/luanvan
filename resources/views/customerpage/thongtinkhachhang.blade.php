
@include('script_cus')
@include('head_cus')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css" rel="stylesheet"> 

<link rel="stylesheet" href="{{asset('frontend/css/thongtinkhachhang.css')}}">
<header>
    <div class="container" style="font-weight: bold;">
        <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
            <div class="container" style="color:red;">
                <a class="navbar-brand" href="{{URL::to('')}}">LIFE<span>Sự lựa chọn an toàn cho bạn</span></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="oi oi-menu"></span> Menu
                </button>
        
                <div class="collapse navbar-collapse" id="ftco-nav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active"><a href="{{URL::to('')}}" class="nav-link">Trang chủ</a></li>
                        <li class="nav-item"><a href="{{URL::to('gioithieu')}}" class="nav-link">Giới thiệu</a></li>
                        @if(session()->has('data'))
                      <li class="nav-item"><a style="color:#00ff0a; border-bottom: double;" href="{{URL::to('thongtinkh/'.session('data')['tentaikhoan'])}}" class="nav-link">Chào bạn: {{session('data')['tentaikhoan']}}</a>
                      </li>
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
    </div>
</header>
<div class="container"> 
    <div class="container"> 
     <div class="row profile">        
      <div class="col-md-3">          
       <div class="profile-sidebar">                                                                  
        <div class="profile-usertitle">                 
   
         <div class="profile-usertitle-name">{{$taikhoan->tentaikhoan}}</div>    
            <?php  $date = new DateTime($taikhoan->created_at); ?>
         <div class="profile-usertitle-job">Ngày tạo : <?php echo $date->format('d-m-Y');?></div>              
        </div>                                                
        <div class="profile-userbuttons">                 
         <a href="{{URL::to('')}}"><button type="button" class="btn btn-success btn-sm">Trang chủ</button></a>              
         <a href="{{URL::to('dangxuatKH')}}"><button type="button" class="btn btn-danger btn-sm">Thoát ra</button>                
        </div></a>                                            
        <div class="profile-usermenu">                    
         <ul class="nav">
            
            <!-- <div class="menu-icon"><span>Menu</span></div>                       -->
          <li class="active"><a href="{{URL::to('thongtinkh/'.session('data')['tentaikhoan'])}}"><i class="glyphicon glyphicon-info-sign"></i>Cập nhật thông tin cá nhân </a>                     
          </li>     
          <li><a href="{{URL::to('doimatkhau/'.$taikhoan->tentaikhoan)}}"><i class="glyphicon glyphicon-shopping-cart"></i>Đổi mật khẩu </a>                       
          </li>                                    
          <li><a href="{{URL::to('lichsudatve')}}"><i class="glyphicon glyphicon-shopping-cart"></i>Lịch sử đặt vé </a>                       
          </li>                       
          {{-- <li><a href="https://hocwebgiare.com/"><i class="glyphicon glyphicon-envelope"></i>Tin nhắn</a>                       
          </li>                    --}}
         </ul>                
        </div>                            
       </div>     
      </div>      
      
      <div class="col-md-9">
          <h1 class="thongtinkhachhang">Thông tin khách hàng</h1> 
       <div class="profile-content">
        <form action="{{URL::to('suathongtinkh/'.session('data')['tentaikhoan'])}}" method="POST">
          <input type="hidden" name="_token" value="{{csrf_token()}}" />
            <div class="form-row">
              <div class="col-md-6 mb-3">
                <label for="validationCustom01">Tên tài khoản</label>
                <input type="text" class="form-control" id="validationCustom01" name="tentaikhoan" value="{{$taikhoan->tentaikhoan}}" disabled="">
              </div>
              <div class="col-md-6 mb-3">
                <label for="validationCustomUsername">Họ tên</label>                    
                  <input type="text" class="form-control" id="validationCustomUsername" value="{{$taikhoan->hoten}}" aria-describedby="inputGroupPrepend" name="hoten">
                  <span class="error-message">{{ $errors->first('hoten') }}</span>
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-6 mb-3">
                <label for="validationCustom03">Email</label>
                <input type="text" class="form-control" id="validationCustom03" name="email" value="{{$taikhoan->email}}" required>        
                <span class="error-message">{{ $errors->first('email') }}</span>  
              </div>
              <div class="col-md-3 mb-3">
                <label for="validationCustom04">Giới tính</label>
                <select class="form-control" name="gioitinh">
                  @if($taikhoan->gioitinh == 1)
                    <option value="1">Nam</option>
                    <option value="0">Nữ</option>
                  @else
                    <option value="0">Nữ</option>
                    <option value="1">Nam</option>
                  @endif
                </select>
            
              </div>
              <div class="col-md-3 mb-3">
                <label for="validationCustom05">CMND</label>
                <input type="text" class="form-control" id="validationCustom05" placeholder="CMND" required name="cmnd" value="{{$taikhoan->cmnd}}">  
                <span class="error-message">{{ $errors->first('cmnd') }}</span>     
              </div>
              <div class="col-md-6 mb-3">
                <label for="validationCustom05">Số điện thoại</label>
                <input type="text" class="form-control" id="validationCustom05" placeholder="Phone" required name="sdt" value="{{$taikhoan->sdt}}">     
                <span class="error-message">{{ $errors->first('sdt') }}</span>  
              </div>
              <div class="col-md-6 mb-3">
                <label for="validationCustom03">Địa chỉ</label>
                <input type="text" class="form-control" id="validationCustom03" required value="{{$taikhoan->diachi}}" name="diachi" >     
                <span class="error-message">{{ $errors->first('diachi') }}</span>     
              </div>
            </div>        
            @if(session('thanhcong'))
            <div class="alert alert-success text-center">
                {{session('thanhcong')}}
            </div>
            @endif
            <button style="float: right;" class="btn btn-primary" type="submit">Lưu thông tin</button>     
          </form>
    </div>     
      </div>  
     </div>
    </div> 
   </div>
  
   <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
      'use strict';
      window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();
    </script>

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
  
  