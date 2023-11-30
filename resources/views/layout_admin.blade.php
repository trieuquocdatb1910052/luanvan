
<!DOCTYPE html>

@include('head_admin')

<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="" class="logo">
        LIFE
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <span class="username">
                    @if(session('hoten'))
                            {{session('hoten')}}
                    @endif
                </span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="#"><i class=" fa fa-suitcase"></i>Hồ sơ</a></li>
                <li><a href="{{URL::to('logout')}}"><i class="fa fa-key"></i>Đăng xuất</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
       
    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="active" href="{{URL::to('dashboard')}}">
                        <i class="fa fa-dashboard"></i>
                        <span>Tổng quan</span>
                    </a>
                </li>
                
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-car"></i>
                        <span>Quản lý xe</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/danhsachxe')}}">Danh sách thông tin xe</a></li>
						<li><a href="{{URL::to('/themxe')}}">Thêm xe</a></li>
                        {{-- <li><a href="grids.html">Quản lý chuyến xe</a></li> --}}
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-road"></i>
                        <span>Quản lý tuyến xe</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/danhsachtuyenxe')}}">Danh sách tuyến xe</a></li>
						<li><a href="{{URL::to('/themtuyenxe')}}">Thêm tuyến xe mới</a></li>
                        {{-- <li><a href="grids.html">Quản lý chuyến xe</a></li> --}}
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-calendar"></i>
                        <span>Quản lý chuyến xe</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/danhsachchuyenxe')}}">Danh sách chuyến xe</a></li>
						<li><a href="{{URL::to('/themchuyenxe')}}">Thêm chuyến xe mới</a></li>
                        {{-- <li><a href="grids.html">Quản lý chuyến xe</a></li> --}}
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-user"></i>
                        <span>Quản lý khách hàng</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/danhsachusers')}}">Danh sách Khách hàng</a></li>
				
                        {{-- <li><a href="grids.html">Quản lý chuyến xe</a></li> --}}
                    </ul>
                </li>
                <!-- <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-user"></i>
                        <span>Quản lý Admin</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/danhsachadmin')}}">Danh sách Admin</a></li>
                        <li><a href="{{URL::to('/themadmin')}}">Thêm Admin</a></li>
                        {{-- <li><a href="grids.html">Quản lý chuyến xe</a></li> --}}
                    </ul>
                </li> -->
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-ticket"></i>
                        <span>Quản lý vé </span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/danhsachve')}}">Danh sách vé</a></li>
            </ul>            
        </div>
    </div>
</aside>
<!--sidebar end-->
<section id="main-content">
	<section class="wrapper"> 
    @yield('content_admin')
</section>
 <!-- footer -->
		  <div class="footer">
			<div class="wthree-copyright" style="text-align: center;">
			  <p>Copyright © 2023</p>
			</div>
		  </div>
  <!-- / footer -->
</section>
<!--main content end-->
</section>

@include('script_admin')

</body>
</html>
