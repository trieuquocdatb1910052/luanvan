
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
   
         <div class="profile-usertitle-name">{{$taikhoan1->tentaikhoan}}</div>    
            <?php  $date = new DateTime($taikhoan1->created_at); ?>
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
          <li><a href="{{URL::to('doimatkhau/'.$taikhoan1->tentaikhoan)}}"><i class="glyphicon glyphicon-shopping-cart"></i>Đổi mật khẩu </a>                               
          <li><a href="{{URL::to('lichsudatve')}}"><i class="glyphicon glyphicon-shopping-cart"></i>Lịch sử đặt vé </a>                       
          </li>                         
          {{-- <li><a href="https://hocwebgiare.com/"><i class="glyphicon glyphicon-envelope"></i>Tin nhắn</a>                       
          </li>                    --}}
         </ul>                
        </div>                            
       </div>     
      </div>      
      
      <div class="col-md-9">
      
          <h1 class="thongtinkhachhang">Lịch sử đặt vé</h1> 
       <div class="profile-content">
        {{-- <h1>Lịch sử đặt vé: {{$count}}</h1> --}}


       
        <table class="table table-hover">
          <thead class="thead-dark">
            <tr>
              <th scope="col">STT</th>
              <th scope="col">Mã vé</th>
              <th scope="col">Số lượng</th>
              <th scope="col">Tổng tiền</th>
              <th scope="col">Ngày đặt</th>
              <th scope="col">Trạng thái</th>
              <th scope="col">Thao tác</th>
            </tr>
          </thead>
          <tbody>
            @foreach($vedadat as $vht)
            <tr>
              <th scope="row">{{$vht->stt}}</th>
              <td>{{"0".$vht->idve.date('ymd', strtotime($vht->created_at))}}</td>
              <td>{{$vht->soluong}}</td>
              <td>{{number_format($vht->tongtien)}} <i style="text-align: left">VND</i></td>
              <td>{{ date('j.m.Y', strtotime($vht->created_at)) }}</td>
              <td>
                @if($vht->trangthai==0)
                  {{'Chờ thanh toán'}}
                  <td>
                    <a class="btn btn-warning" href="{{route('huyve',$vht->idve)}}">Huỷ vé</a>
                  </td>
                  <td><a href="{{route('thanhtoan',$vht->idve)}}"><p class="btn btn-warning">Thanh toán ngay</p></a> <br></td>    
                  @elseif($vht->trangthai == 1)
                  {{'Đã thanh toán'}}
                  @else
                  {{'Đã hủy'}}
                  @endif
                  <td>
                    <a class="btn btn-success" href="{{route('chitietveuser',$vht->idve)}}">Chi tiết</a>
                  </td>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        @if(session('thanhcong'))
        <div class="alert alert-info text-center">
            {{session('thanhcong')}}
        </div>
        @endif
        
      
       
    </div>     
      </div>  
     </div>
    </div> 
   </div>
  

    <style type="text/css">
      /* màu hiển thị lỗi*/
    .error-message { color: red; }
    @import url("//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css");
     