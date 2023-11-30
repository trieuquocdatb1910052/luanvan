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
        <h1 class="thongtinkhachhang">Thông tin chi tiết hành khách</h1> 
     <div class="profile-content">
      <a class="btn btn-primary" href="{{URL::to('lichsudatve')}}">Trở về</a>
          <table class="table table-hover">
            <thead class="thead-dark">
              <tr>
                <th scope="col">STT</th>
                <th scope="col">CMND</th>
                <th scope="col">Họ tên</th>
                <th scope="col">SĐT</th>
                <th scope="col">Tuyến</th>
                <th  scope="col">Thời gian</th>
                <th  scope="col">Vị trí ghế</th>
              </tr>
            </thead>
            <tbody>
              <tr>
          @foreach($ve as $v)     
                <th>{{$v->stt}}</th>
                <td scope="row">{{$v->cmndnguoidi}}</td>
                <td>{{$v->hotennguoidi}}</td>
                <td>
                  {{$v->sdt}}
                </td>
                <td>{{$v->diemdi}} - {{$v->diemden}}</td>
                <td> <i>{{$v->giodi}}</i>||{{date('j.m.Y', strtotime($v->ngaydi))}}</td>
                <td>{{$v->chongoi}}</td>
              </tr>
          @endforeach  

            </tbody>
          </table>
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


/* <link rel="stylesheet" type="text/css" href="">
    <main>
        <div style="margin-top: 20px;"></div>
        
        <div class="container">
         
          <h1>Danh sách người đi</h1>
          @foreach($ve as $v)     
          <table class="table table-striped">
            <thead>
              <tr style="text-align: center;">
                <th scope="col">CMND</th>
                <th scope="col">Họ tên</th>
                <th scope="col">Giới tính</th>
                <th scope="col">SĐT</th>
                <th scope="col">Chuyến</th>
                <th  scope="col">Thời gian</th>
                <th  scope="col">Vị trí ghế</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td scope="row">{{$v->cmndnguoidi}}</td>
                <td>{{$v->hotennguoidi}}</td>
                <td> @if($v->gioitinh == 1)
                  {{'Nam'}}
                  @else
                  {{'Nữ'}}
                  @endif</td>
                <td>
                  {{$v->sdt}}
                </td>
                <td>{{$v->diemdi}} - {{$v->diemden}}</td>
                <?php $today = date("d.m.y");  ?>
                <td><b>Khởi hành:</b> {{substr($v->giodi,0,5)}} ||| {{$v->ngaydi}}</td>
                <td>{{$v->chongoi}}</td>
              </tr>
            </tbody>
          </table>
          @endforeach  
               
        </div>
                         
    </main> */
