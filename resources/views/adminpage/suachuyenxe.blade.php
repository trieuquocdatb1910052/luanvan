@extends('layout_admin')
@section('content_admin')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhập chuyến xe
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
                        <form role="form" action="{{URL::to('suachuyenxe/'.$chuyenxe->idchuyenxe)}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giờ đi (Ex : 00:00 - AM/PM)</label>
                            <input type="time" class="form-control" id="giodi" name="giodi" placeholder="Nhập giờ đi" value="{{$chuyenxe->giodi}}">
                            <span class="error-message">{{ $errors->first('giodi') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="inputName">Giờ đến (<i>dự kiến</i>)</label>
                            <input type="time" class="form-control" id="gioden" name="gioden" placeholder="Vui lòng chọn nhập giờ đến (00:00)" value="{{$chuyenxe->gioden}}">
                            <span class="error-message">{{ $errors->first('gioden') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Ngày đi</label>
                            <input type="date" class="form-control" id="ngaydi" name="ngaydi" placeholder="Chọn ngày đi (dd/mm/yyyy)" value="{{$chuyenxe->ngaydi}}">
                            <span class="error-message">{{ $errors->first('ngaydi') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Ngày đến </label>
                            <input type="date" class="form-control" id="ngayden" name="ngayden" placeholder="Chọn ngày đến (dd/mm/yyyy)" value="{{$chuyenxe->ngayden}}">
                            <span class="error-message">{{ $errors->first('ngayden') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nơi xuất bến </label>
                            <input type="text" class="form-control" id="noixuatben" name="noixuatben" value="{{$chuyenxe->noixuatben}}">
                            <span class="error-message">{{ $errors->first('noixuatben') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="inputName">Chọn tuyến xe</label>
                            <select class="form-control" name="idtuyenxe">           
                                <option value="{{$chuyenxe->idtuyenxe}}"> {{$chuyenxe->diemdi}} - {{$chuyenxe->diemden}}
                                   </option>
                                   @foreach($tuyenxe as $tuyen)
                                  <option value="{{$tuyen->idtuyenxe}}" >{{$tuyen->diemdi}} - {{$tuyen->diemden}}</option>
                                  @endforeach
                              </select>
                        </div>

                        <div class="form-group">
                            <label for="inputName">Chọn xe</label>
                            <select class="form-control" name="idxe">
                                    
                                <option value="{{$chuyenxe->idxe}}"> Biển số: {{$chuyenxe->bienso}} - Số ghế: {{$chuyenxe->soghe}}
                                </option>
                                @foreach($xe as $x)
                                @if($x->trangthai==1)
                              <option value="{{$x->idxe}}"> Biển số: {{$x->bienso}} || Số ghế: {{$x->soghe}} </option>
                                @endif
                               @endforeach
                           </select>
                        </div>
                        
                   
            
                        <div class="form-group">
                           <a href="{{URL::to('danhsachchuyenxe')}}" class="btn btn-secondary">Trở về</a>           
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
 