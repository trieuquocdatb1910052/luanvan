@extends('layout_admin')
@section('content_admin')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhập thông tin xe
                </header>
            @if(session('thongbao'))
            <p>
          <div style="text-align: center" class="alert alert-warning">
              {{session('thongbao')}}
          </div>
          </p>
          @endif
                <div class="panel-body">
                    
                    <div class="position-center">
                        <form role="form" action="{{ URL::to('suaxe/'.$xe->idxe) }}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Biển số</label>
                            <input type="text" class="form-control" id="bienso" name="bienso" placeholder="Nhập biển số xe" value="{{$xe->bienso}}">
                            <span class="error-message">{{ $errors->first('bienso') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Số lượng ghế</label>
                            <input type="text" class="form-control" id="soghe" name="soghe" placeholder="Nhập số lượng ghế" value="{{$xe->soghe}}"> 
                            <span class="error-message">{{ $errors->first('soghe') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Chọn loại xe</label>
                            <select class="form-control" name="loaixe">    
                                <option value="{{$xe->loaixe}}">
                                    @if($xe->loaixe == 0)
                                        {{'Ghế ngồi'}}
                                    @else
                                        {{'Giường nằm'}}
                                     @endif
                                </option>     
                                  <option value="0">Ghế ngồi</option>
                                  <option value="1">Giường nằm</option>
                                  <span class="error-message">{{ $errors->first('loaixe') }}</span>  
                              </select>
                        </div>
                    
                        <div class="form-group">
                            <label for="inputName">Hình xe</label>
                            <p>
                                <img  width="150px" src="{{URL::to('images/anhxe/'.$xe->hinhxe)}}">
                              </p>
                              
                            <input type="file" id="hinhxe" name="hinhxe" class="form-control" placeholder="Chọn hình xe" value="">
                            <input type="hidden" id="hinhxecu" name="hinhxecu" class="form-control" placeholder="Chọn hình xe mới" value="{{$xe->hinhxe}}">
                            <span class="error-message">{{$errors->first('hinhxe')}}</span>
                          </div>
                           
                            
            
                        <div class="form-group">
                           <a href="{{URL::to('danhsachxe')}}" class="btn btn-secondary">Trở về</a>           
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
 