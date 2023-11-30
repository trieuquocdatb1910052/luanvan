
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
      
          <h1 class="thongtinkhachhang">Đổi mật khẩu</h1> 
       <div class="profile-content">
        <form action="{{URL::to('doimatkhau/'.$taikhoan->tentaikhoan)}}" method="POST">
          <input type="hidden" name="_token" value="{{csrf_token()}}" />
          <div class="containerdoimatkhau">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-2">
                    <div class="panel panel-info">
                        <div class="panel-body">
                            <div class="row">                      
                                <div class="col-xs-6 col-sm-6 col-md-6 login-box">
                                 <div class="form-group">
                                    <div class="input-group">
                                      <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                                      <input class="form-control" type="password" name="password" placeholder="Nhập mật khẩu cũ"> 
                                      <span class="error-message">{{ $errors->first('password') }}</span>
                                      @if(session('thongbao'))
                                      <small class="alert alert-danger text-center">
                                          {{session('thongbao')}}
                                      </small>
                                      @endif
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="input-group">
                                      <div class="input-group-addon"><span class="glyphicon glyphicon-log-in"></span></div>
                                      <input class="form-control" type="password" placeholder="Mật khẩu mới" name="password1">
                                      <span class="error-message">{{ $errors->first('password1') }}</span>
                                    </div>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-log-in"></span></div>
                                        <input class="form-control" type="password" placeholder="Xác nhận mật khẩu mới" name="password2">
                                        <span class="error-message">{{ $errors->first('password2') }}</span>
                                      </div>
                                  </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-5"></div>
                                
                                    <button class="btn icon-btn-save btn-success" type="submit">
                                    <span class="btn-save-label"><i class="glyphicon glyphicon-floppy-disk"></i></span>cập nhật</button>                           
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
            @if(session('thanhcong'))
            <div class="alert alert-success text-center">
                {{session('thanhcong')}}
            </div>
            @endif
        
          </form>
    </div>     
      </div>  
     </div>
    </div> 
   </div>
  

    <style type="text/css">
      /* màu hiển thị lỗi*/
    .error-message { color: red; }
    @import url("//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css");
     