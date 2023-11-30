@extends('layout_admin')
@section('content_admin')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <h2 class="panel-heading">
                    Thêm ghi chú
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
                        <form role="form" action="{{route('capnhatlydo',$user->idtk)}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Lý do</label>
                            <input type="text" class="form-control" id="lydo" name="lydo" placeholder="Nhập Email" value="{{$user->lydo}}">
                            <span class="error-message">{{ $errors->first('lydo') }}</span>
                        </div>
                    
                        <div class="form-group">
                           <a href="{{URL::to('danhsachusers')}}" class="btn btn-secondary">Trở về</a>           
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
 