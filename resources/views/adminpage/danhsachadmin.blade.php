@extends('layout_admin')
@section('content_admin')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Danh sách thông tin Admin
      </div>
      @if(session('thongbao'))
      <p>
          <div style="text-align: center" class="alert alert-warning">
              {{session('thongbao')}}
          </div>
          </p>
      @endif

      <div class="table-responsive">
        <table id="example1" class=" table-bordered table-striped table-hover" style="width: 100%;">
          <thead>
            <tr>
              {{-- <th style="width:20px;">
                <label class="i-checks m-b-none">
                  <input type="checkbox"><i></i>
                </label>
              </th>   --}}
                    <th>ID</th>
                    <th>Email</th>
                    <th>Họ tên</th>
                    <th>Giới tính</th>
                    <th>CMND</th>
                    <th>Địa chỉ</th>
                    <th>Số điện thoại</th>
                    <th>Trạng thái</th>
                    <th>Ghi chú</th>
                    <th>Thao tác </th>
      
            </tr>
          </thead>
          <tbody>
            <tr>
              {{-- <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td> --}}
              @foreach($users as $u)  
              <td>{{$u->idtk}}</td>
              <td>{{$u->email}}</td>
              <td>{{$u->hoten}}</td>
              <td>
              @if($u->gioitinh == 1)
              {{'Nam'}}
              @else
              {{'Nữ'}}
              @endif
            </td>
              <td >
                {{$u->cmnd}}
              </td>
              <td >
                {{$u->diachi}}
              </td>
              <td >
                {{$u->sdt}}
              </td>
             <td>
              @if($u->trangthai==1)
    
              Đang hoạt động <a href="{{route('capnhatadmin',$u->idtk)}}"  class="active" ui-toggle-class="" 
                onclick="return confirm('Bạn có chắc muốn cập nhật trạng thái này không')"> (Khóa)
              @else
              Ngưng hoạt động   <a href="{{route('capnhatadmin',$u->idtk)}}"  class="active" ui-toggle-class="" 
                onclick="return confirm('Bạn có chắc muốn cập nhật trạng thái này không')"> (Mở)
              @endif</td>
              <td>
                @if($u->lydo!=null)
                  {{$u->lydo}} 
                  <a href="{{route('capnhatlydo',$u->idtk)}}"  class="active" ui-toggle-class="" 
                    onclick="return confirm('Bạn có chắc muốn sửa ghi chú không')">( Sửa ghi chú)
                @else
                <a href="{{route('capnhatlydo',$u->idtk)}}"  class="active" ui-toggle-class="" 
                  onclick="return confirm('Bạn có chắc muốn thêm ghi chú không')"> Thêm ghi chú
                @endif</td>
              <td>
                <a href="{{route('suaadmin',$u->idtk)}}"  class="active" ui-toggle-class="" 
                  onclick="return confirm('Bạn có chắc muốn sửa không')"> Sửa
                </td></tr>
            @endforeach
         
           
       
         
         
          </tbody>
          <tfoot>
            <tr>
              <th>ID</th>
              <th>Email</th>
              <th>Họ tên</th>
              <th>Giới tính</th>
              <th>CMND</th>
              <th>Địa chỉ</th>
              <th>Số điện thoại</th>
              <th>Trạng thái</th>
              <th>Ghi chú</th>
              <th>Thao tác </th>

            </tr>
          </tfoot>
        </table>
      </div>
      <footer class="panel-footer">
        <div class="row">

      
        </div>
      </footer>
    </div>
  </div>
  <script>
    $(function () {
    $("#example1").DataTable({
      "responsive": true, // tương thích vs các thiết bị
      "autoWidth": false, // thay đổi độ rộng thông minh
      "paging":true, //tính năng phân trang
      "language": {
       "decimal":        "",
       "emptyTable":     "No data available in table",
    "info":           "Showing _START_ to _END_ of _TOTAL_ entries",
    "infoEmpty":      "Showing 0 to 0 of 0 entries",
    "infoFiltered":   "(filtered from _MAX_ total entries)",
    "infoPostFix":    "",
    "thousands":      ",",
    "lengthMenu":     "Hiển thị _MENU_ dữ liệu",
    "loadingRecords": "Loading...",
    "search":         "Tìm kiếm:",
    "zeroRecords":    "Không tìm thấy giá trị bạn cần tìm",
    "paginate": {
        "first":      "First",
        "last":       "Last",
        "next":       "Trang sau",
        "previous":   "Trang trước"
    },    
  },
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
@endsection
<style type="text/css">
        /* màu hiển thị lỗi*/
        .error-message { color: red; }
 </style>
 