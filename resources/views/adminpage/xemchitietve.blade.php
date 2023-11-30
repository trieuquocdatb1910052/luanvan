@extends('layout_admin')
@section('content_admin')

<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Danh sách người đi 
      </div>
     
      
      {{-- <div> <a href="{{('themxe')}}"><button style="float:right;" class="btn btn-primary">Thêm mới</button></a></div> --}}
     
      <div class="table-responsive">
        @if(session('thongbao'))
        <div class="alert alert-info text-center">
            {{session('thongbao')}}
        </div>
        @endif

        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              {{-- <th style="width:20px;">
                <label class="i-checks m-b-none">
                  <input type="checkbox"><i></i>
                </label>
              </th>   --}}
            
              <th>Chứng minh nhân dân</th>
              <th>Họ và tên </th>
              <th>Giới tính</th>
              <th>Số điện thoại</th>
              <th>Chuyến xe</th>
              <th>Vị trí ghế</th>
              <th>Thời gian khởi hành</th>
              <th>Thao tác</th>
        
             
            </tr>
          </thead>
          <tbody>
            <tr>
              {{-- <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td> --}}
              
              @foreach($ve as $v)        
                  <tr> 
                    
                    <td>{{$v->cmndnguoidi}}</td>
                    <td>{{$v->hotennguoidi}}</td>
                    <td>
                      @if($v->gioitinh == 1)
                      {{'Nam'}}
                      @else
                      {{'Nữ'}}
                      @endif
                    </td>
                    <td>{{$v->sdtnguoidi}}</td>
                    <td>{{$v->diemdi}}->{{$v->diemden}}</td>
                    <td>{{$v->chongoi}}</td>
                    <td><b>Khởi hành:</b>{{$v->giodi}} ||| <b>Ngày đi :</b> {{$v->ngaydi}}</td>
                
                    <td>
                        <a href="{{route('suanguoidi',$v->cmndnguoidi)}}"  class="active" ui-toggle-class="" 
                            onclick="return confirm('Bạn có chắc muốn cập nhật trạng thái này không')">Sửa
                    </td>
                
                    
                  </tr>
                  @endforeach   
          </tbody>
  
        </table>
      </div>

    </div>      <a href="{{URL::to('danhsachve')}}" class="btn btn-primary" data-dismiss="modal">Trở về</a>     
  </div>
@endsection
<style type="text/css">
        /* màu hiển thị lỗi*/
        .error-message { color: red; }
 </style>
 