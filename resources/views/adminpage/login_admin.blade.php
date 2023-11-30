
<!DOCTYPE html>
<head>
<title>Đăng nhập Admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="{{('frontend/css/css_admin/bootstrap.min.css')}}" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{asset('frontend/css/css_admin/style.css')}}" rel='stylesheet' type='text/css' />
<link href="{{asset('frontend/css/css_admin/style-responsive.css')}}" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{asset('frontend/css/css_admin/font.css')}}" type="text/css"/>
<link href="{{('frontend/css/css_admin/font-awesome.css')}}" rel="stylesheet"> 
<!-- //font-awesome icons -->
<script src="{{asset('frontend/js/js_admin/jquery2.0.3.min.js')}}"></script>
</head>
<body>
<div class="log-w3">
<div class="w3layouts-main">
	<h2>Đăng nhập</h2>
	

	<!-- Thông báo sai tk, mk -->
		@if(session('thongbao'))
		<small>
			<div class="alert alert-danger">
				{{session('thongbao')}}
			</div>
			</small>
		@endif

	<!-- Thông báo tài khoản bị khóa -->
		@if(session('thongbaokhoa'))
		<div class="alert alert-danger text-center" style="font-weight: bold;">
			{{session('thongbaokhoa')}}
		</div>
		@endif

		<form action="{{URL::to('/dashboard_admin')}}" method="post">
			{{ csrf_field() }}
			<input type="text" class="ggg" name="tentaikhoan" placeholder="Tên tài khoản" required="">
			<input type="password" class="ggg" name="password" placeholder="Mật khẩu" required="">
			<span><input type="checkbox"/> Lưu đăng nhập </span>
			<h6><a href="#">Quên mật khẩu?</a></h6>
				<div class="clearfix"></div>
				<input type="submit" value="Đăng nhập" name="login">
		</form>
		{{-- <p>Don't Have an Account ?<a href="registration.html">Create an account</a></p> --}}
</div>
</div>
<script src="{{asset('frontend/js/js_admin/bootstrap.js')}}"></script>
<script src="{{asset('frontend/js/js_admin/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('frontend/js/js_admin/scripts.js')}}"></script>
<script src="{{asset('frontend/js/js_admin/jquery.slimscroll.js')}}"></script>
<script src="{{asset('frontend/js/js_admin/jquery.nicescroll.js')}}"></script>
<script src="{{asset('frontend/js/js_admin/jquery.scrollTo.js')}}"></script>
</body>
</html>
