@extends('layout_admin')
@section('content_admin')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <h2 class="panel-heading">
                    Thêm thông tin Admin  
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
                        <form role="form" action="{{route('suaadmin',$user->idtk)}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Nhập Email" value="{{$user->email}}">
                            <span class="error-message">{{ $errors->first('email') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="inputName">Họ tên</label>
                            <input type="text" class="form-control" id="hoten" name="hoten" placeholder="Nhập Họ tên" value="{{$user->hoten}}">
                            <span class="error-message">{{ $errors->first('hoten') }}</span>
                        </div>
                    
                    
                        <div class="form-group">
                            <label for="inputName">Giới tính</label>
                            @if($user->gioitinh == 1)
                            <input name="gioitinh" type="radio" value="1" checked/>Nam
                            <input name="gioitinh" type="radio" value="0" />Nữ
                            @else 
                            <input name="gioitinh" type="radio" value="1" />Nam
                            <input name="gioitinh" type="radio" value="0"checked />Nữ
                            @endif
                          </div>
                          <div class="form-group">
                            <label for="inputName">Căn Cước Công Dân</label>
                            <input type="text" class="form-control" id="cmnd" name="cmnd" placeholder="Nhập CCCD" value="{{$user->cmnd}}">
                            <span class="error-message">{{ $errors->first('cmnd') }}</span>
                        </div>     <div class="form-group">
                            <label for="inputName">Địa chỉ</label>
                            <input type="text" class="form-control" id="diachi" name="diachi" placeholder="Nhập CCCD" value="{{$user->diachi}}">
                            <span class="error-message">{{ $errors->first('diachi') }}</span>
                        </div>     <div class="form-group">
                            <label for="inputName">Số điện thoại</label>
                            <input type="text" class="form-control" id="sdt" name="sdt" placeholder="Nhập CCCD" value="{{$user->sdt}}">
                            <span class="error-message">{{ $errors->first('sdt') }}</span>
                        </div>
                            
            
                        <div class="form-group">
                           <a href="{{URL::to('danhsachadmin')}}" class="btn btn-secondary">Trở về</a>           
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
 