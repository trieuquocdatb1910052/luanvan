@extends('layout_admin')
@section('content_admin')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm mới xe
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
                        <form role="form" action="{{URL::to('/themxe')}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Biển số</label>
                            <input type="text" class="form-control" id="bienso" name="bienso" placeholder="Nhập biển số xe" value="{{old('bienso')}}">
                            <span class="error-message">{{ $errors->first('bienso') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Số lượng ghế</label>
                            <input type="text" class="form-control" id="soghe" name="soghe" placeholder="Nhập số lượng ghế">
                            <span class="error-message">{{ $errors->first('soghe') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Chọn loại xe</label>
                            <select class="form-control" name="loaixe">                            
                                  <option value="0">Ghế ngồi</option>
                                  <option value="1">Giường nằm</option>
                                  <span class="error-message">{{ $errors->first('loaixe') }}</span>  
                              </select>
                        </div>
                    
                        <div class="form-group">
                            <label for="inputName">Hình xe</label>
                        <input type="file" id="hinhxe" name="hinhxe" class="form-control" placeholder="Chọn hình xe">
                            <span class="error-message">{{ $errors->first('hinhxe') }}</span>
                        </div>
                           
                            
            
                        <div class="form-group">
                           <a href="#" class="btn btn-secondary">Trở về</a>           
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