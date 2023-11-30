@extends('layout_admin')
@section('content_admin')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhập thông tin tuyến xe
                </header>
                @if(session('thongbao'))
                <p>
                    <div class="alert alert-danger">
                        {{session('thongbao')}}
                    </div>
                    </p>
                @endif
                <div class="panel-body">
                    
                    <div class="position-center">
                        <form role="form" action="{{ URL::to('suatuyenxe/'.$tuyenxe->idtuyenxe) }}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Điểm đi</label>
                            <input type="text" class="form-control" id="diemdi" name="diemdi"  value="{{$tuyenxe->diemdi}}">
                            <span class="error-message">{{ $errors->first('diemdi') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Điểm đến</label>
                            <input type="text" class="form-control" id="diemden" name="diemden" placeholder="Nhập số lượng ghế" value="{{$tuyenxe->diemden}}" > 
                            <span class="error-message">{{ $errors->first('diemden') }}</span>
                        </div>
                    
                        <div class="form-group">
                            <label for="inputName">Hình ảnh</label>
                            <p>
                                <img  width="150px" src="{{URL::to('images/anhtuyenxe/'.$tuyenxe->hinhanh)}}">
                              </p>
                              
                            <input type="file" id="hinhanh" name="hinhanh" class="form-control" placeholder="Chọn hình xe" value="">
                            <input type="text" id="hinhanh2" name="hinhanh2" value="{{$tuyenxe->hinhanh}}"  class="form-control">
                            <span class="error-message">{{$errors->first('hinhanh')}}</span>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Giá tiền</label>
                            <input type="text" class="form-control" id="dongia" name="dongia" placeholder="Nhập số lượng ghế" value="{{$tuyenxe->dongia}}" > 
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
<script >
$(document).ready(function(){
    $("#giodi").clockTimePicker();
  });
  
  </script>
@endsection
<style type="text/css">
    /* màu hiển thị lỗi*/
    .error-message { color: red; }
 </style>
 