{{-- <script src='https://cdn.jsdelivr.net/gh/vietblogdao/js/districts.min.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> --}}





@extends('layout_admin')
@section('content_admin')  


    <div class="col-lg-12">
            <section class="panel">
                <h2 class="panel-heading">
                    Thêm tuyến xe mới  
                </h2>
                @if(session('thongbao'))
                <p>
                    <div class="alert alert-info text-center">
                        {{session('thongbao')}}
                    </div>
                    </p>
                @endif
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action="{{URL::to('/themtuyenxe')}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Điểm đi</label>
                            <select name="diemdi" class="form-control">
                              @foreach($tinhthanh as $t)
                                <option value="{{$t->ten_tinh}}">{{$t->ten_tinh}}</option>
                              @endforeach
                              </select> 
                              {{-- <input class="billing_address_1" name="diemdi" type="text" value="">
                            
                            {{-- <input type="text" class="form-control" id="diemdi" name="diemdi" placeholder="Nhập điểm đi" value="{{old('bienso')}}"> --}}
                            {{-- <span class="error-message">{{ $errors->first('diemdi') }}</span> --}}
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Điểm đến</label>
                            <select name="diemden" class="form-control">
                              @foreach($tinhthanh as $t)
                                <option value="{{$t->ten_tinh}}">{{$t->ten_tinh}}</option>
                              @endforeach
                              </select> 
                            {{-- <input type="text" class="form-control" id="diemden" name="diemden" placeholder="Nhập điểm đến"> --}}
                            <span class="error-message">{{ $errors->first('diemden') }}</span>
                        </div>
                    
                    
                        <div class="form-group">
                            <label for="inputName">Hình ảnh</label>
                            <input type="file" id="hinhanh" name="hinhanh" class="form-control" placeholder="Chọn hình">
                            <span class="error-message">{{ $errors->first('hinhanh') }}</span>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Đơn giá</label>
                            <input type="text" class="form-control" id="dongia" name="dongia" placeholder="Nhập giá tiền" value="{{old('dongia')}}">
                            <span class="error-message">{{ $errors->first('dongia') }}</span>
                        </div>
                            
            
                        <div class="form-group">
                           <a href="{{URL::to('danhsachtuyenxe')}}" class="btn btn-secondary">Trở về</a>           
                      <button id="btn-luu" name="btn-luu" class="btn btn-success float-right"> Lưu
                      </button>
                      </div>
                    </form>
                    </div>

                </div>
            </section>
</div>  




@endsection



<style type="text/css">
    /* màu hiển thị lỗi*/
    .error-message { color: red; }
 </style>
 

