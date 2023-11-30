@extends('layout_admin')
@section('content_admin')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Sửa người đi
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
                        <form role="form"  action="{{route('suanguoidi',$nguoidi->cmndnguoidi)}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">CMND</label>
                            <input type="text" class="form-control" id="cmndnguoidi" name="cmndnguoidi"  value="{{$nguoidi->cmndnguoidi}}" readonly>
                            <span class="error-message">{{ $errors->first('cmndnguoidi') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Họ và tên</label>
                            <input type="text" class="form-control" id="hotennguoidi" name="hotennguoidi"  value="{{$nguoidi->hotennguoidi}}" > 
                            <span class="error-message">{{ $errors->first('hotennguoidi') }}</span>
                        </div>
                    
                        <div class="form-group">
                            <label for="inputName">Giới tính</label>
                            @if($nguoidi->gioitinhnguoidi == 1)
                            <input name="gioitinhnguoidi" type="radio" value="1" checked/>Nam
                            <input name="gioitinhnguoidi" type="radio" value="0" />Nữ
                            @else 
                            <input name="gioitinhnguoidi" type="radio" value="1" />Nam
                            <input name="gioitinhnguoidi" type="radio" value="0"checked />Nữ
                            @endif
                          </div>

        
                          <div class="form-group">
                            <label for="exampleInputPassword1">Số điện thoại</label>
                            <input type="text" class="form-control" id="sdtnguoidi" name="sdtnguoidi"  value="{{$nguoidi->sdtnguoidi}}" > 
                            <span class="error-message">{{ $errors->first('sdtnguoidi') }}</span>
                        </div>
            
                        <div class="form-group">
                           <a href="{{URL::to('chitietve/'.$nguoidi->idve)}}" class="btn btn-secondary">Trở về</a>           
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
 