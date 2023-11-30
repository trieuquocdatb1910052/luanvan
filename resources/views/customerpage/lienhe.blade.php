@extends('layout')
@section('content')
<section class="ftco-section ftco-no-pb contact-section mb-4">
    <div class="container">
      <div class="row d-flex contact-info">
        <div class="col-md-3 d-flex">
         <div class="align-self-stretch box p-4 text-center">
          <div class="icon d-flex align-items-center justify-content-center">
           <span class="fa fa-map-marker"></span>
         </div>
         <h3 class="mb-2">Địa chỉ</h3>
         <p>Xuân Khanh - Ninh Kiều - Cần Thơ</p>
       </div>
     </div>
     <div class="col-md-3 d-flex">
       <div class="align-self-stretch box p-4 text-center">
        <div class="icon d-flex align-items-center justify-content-center">
         <span class="fa fa-phone"></span>
       </div>
       <h3 class="mb-2">Số điện thoại</h3>
       <p><a href="tel://1234567920">0362069241</a></p>
     </div>
   </div>
   <div class="col-md-3 d-flex">
     <div class="align-self-stretch box p-4 text-center">
      <div class="icon d-flex align-items-center justify-content-center">
       <span class="fa fa-paper-plane"></span>
     </div>
     <h3 class="mb-2">Email</h3>
     <p><a href="mailto:info@yoursite.com">trieuquocdattc@gmail.com</a></p>
   </div>
  </div>
  <div class="col-md-3 d-flex">
   <div class="align-self-stretch box p-4 text-center">
    <div class="icon d-flex align-items-center justify-content-center">
     <span class="fa fa-globe"></span>
   </div>
   <h3 class="mb-2">Website</h3>
   <p><a href="#">ctu.edu.vn</a></p>
  </div>
  </div>
  </div>
  </div>
  </section>
  
  <section class="ftco-section contact-section ftco-no-pt">
    <div class="container">
      <div class="row block-9">
        <div class="col-md-6 order-md-last d-flex">
          <form action="#" class="bg-light p-5 contact-form">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Nhập tên của bạn">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Nhập email">
            </div>
            <div class="form-group">
              <textarea name="" id="" cols="30" rows="7" class="form-control" placeholder="Nhập nội dung tin nhắn"></textarea>
            </div>
            <div class="form-group">
              <input type="submit" value="Gửi" class="btn btn-primary py-3 px-5">
            </div>
          </form>
          
        </div>
  
        <div class="col-md-6 d-flex">
         <div id="map" class="bg-white"></div>
       </div>
     </div>
   </div>
  </section>
  
  <section class="ftco-intro ftco-section ftco-no-pt">
   <div class="container">
    <div class="row justify-content-center">
     <div class="col-md-12 text-center">
      <div class="img"  style="background-image: url(frontend/images/bg_2.jpg);">
       <div class="overlay"></div>
       <h2>chúng tôi đặt an toàn lên hàng đầu</h2>
     </div>
   </div>
  </div>
  </div>
  </section>
  
  
  
  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>
@endsection