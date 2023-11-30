@extends('layout_admin')
@section('content_admin')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <h2 class="panel-heading">
                    Cập nhật trạng thái
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
                        <form role="form" action="{{route('capnhatve',$ve->idve)}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Trạng thái</label>
                            <select id="trangthai" name="trangthai">
                                @if($ve->trangthai==0)
                                <option value="0" selected>Chưa thanh toán</option>
                                <option value="1">Đã thanh toán</option>
                                <option value="2">Hủy vé</option>
                                @elseif ($ve->trangthai==1)
                                <option value="0" >Chưa thanh toán</option>
                                <option value="1"selected>Đã thanh toán</option>
                                <option value="2">Hủy vé</option>
                                @else 
                                <option value="0" >Chưa thanh toán</option>
                                <option value="1">Đã thanh toán</option>
                                <option value="2"selected>Hủy vé</option>
                                @endif
                              </select>

                        </div>
                    
                        <div class="form-group">
                           <a href="{{URL::to('danhsachve')}}" class="btn btn-secondary">Trở về</a>           
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
 