@extends('layout_admin')
@section('content_admin')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Danh sách thông tin khách hàng
      </div>
      @if(session('thongbao'))
      <p>
          <div style="text-align: center" class="alert alert-success">
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
                    <th>STT</th>
                    <th>ID</th>
                    <th>Tên tài khoản</th>
                    <th>Họ tên</th>
                    <th>Giới tính</th>
                    <th>CMND</th>
                    <th>Địa chỉ</th>
                    <th>Số điện thoại</th>
                    <th>Trạng thái</th>
                    <th>Lý do khóa tài khoản</th>

            </tr>
          </thead>
          <tbody>
            <tr>
              {{-- <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td> --}}
              <?php $stt=0 ?>
              @foreach($users as $u) 
              <?php $stt++ ?> 
              <th scope="row"> <?php echo $stt ?></th>
              <td>{{$u->idtk}}</td>
              <td>{{$u->tentaikhoan}}</td>
              <td style="width: 130px;">{{$u->hoten}}</td>
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
    
               <a class="btn btn-success" href="{{route('capnhatusers',$u->idtk)}}"  class="active" ui-toggle-class="" 
                onclick="return confirm('Bạn có chắc muốn cập nhật trạng thái này không')"> Đang hoạt động  
              @else
               <a class="btn btn-warning" href="{{route('capnhatusers',$u->idtk)}}"  class="active" ui-toggle-class="" 
                onclick="return confirm('Bạn có chắc muốn cập nhật trạng thái này không')"> Ngưng hoạt động 
              @endif</td>
              <td>
                @if($u->lydo!=null)
                  {{$u->lydo}} 
                  <a href="{{route('capnhatlydo',$u->idtk)}}"  class="active" ui-toggle-class="" 
                  ><p>( Sửa lý do khóa)</p> 
                @else
                <a class="btn btn-danger" href="{{route('capnhatlydo',$u->idtk)}}"  class="active" ui-toggle-class="" 
                  onclick="return confirm('Bạn có chắc muốn thêm ghi chú không')"> Thêm lý do khóa
                @endif</td></tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th>STT</th>
              <th>ID</th>
              <th>Tên tài khoản</th>
              <th>Họ tên</th>
              <th>Giới tính</th>
              <th>CMND</th>
              <th>Địa chỉ</th>
              <th>Số điện thoại</th>
              <th>Trạng thái</th>
              <th>Lý do khóa tài khoản</th>
              </tr>
            </tfoot>
        </table>
      </div>
      <footer class="panel-footer">
        <div class="row">
  

          </div>
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
 