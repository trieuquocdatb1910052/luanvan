@extends('layout_admin')
@section('content_admin')

<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Danh sách vé
      </div>
     
  


      {{-- <div> <a href="{{('themxe')}}"><button style="float:right;" class="btn btn-primary">Thêm mới</button></a></div> --}}
     
      <div class="table-responsive">
        @if(session('thongbao'))
        <div class="alert alert-info text-center">
            {{session('thongbao')}}
        </div>
        @endif

      <a href="{{URL::to('xuatExcelVe')}}">Export excel</a>
       <table id="example1" class=" table-bordered table-striped table-hover" style="width: 100%;">
          <thead >
            <tr>
            
              <th>Mã phiếu vé</th>
              <th>Chứng minh nhân dân</th>
              <th>Họ và tên</th>
              <th>Giới tính</th>
              <th>Số điện thoại</th>
              <th>Số lượng vé</th>
              <th>Tổng tiền</th>
              <th>Trạng thái</th>
              <th>Chuyến xe</th>
              <th >Thao tác</th>
           
            </tr>
          </thead>
          <tbody>
            <tr>
              {{-- <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td> --}}
              @foreach($PhieuVe as $phieu)        
               
                    @if ( strlen(strval($phieu->idve))==2)
                   
                      <th style="text-align: center;">{{"0".$phieu->idve.date('ymd', strtotime($phieu->created_at))}}<a class="btn btn-primary" href="{{route('chitietve',$phieu->idve)}}">Xem chi tiết vé</a></th>
                      @elseif( strlen(strval($phieu->idve))==1)
                      <th style="text-align: center;">{{"00".$phieu->idve.date('ymd', strtotime($phieu->created_at))}}<a class="btn btn-primary" href="{{route('chitietve',$phieu->idve)}}"> <br>Xem chi tiết vé</a></th>
                      @elseif( strlen(strval($phieu->idve))==3)
                      <th style="text-align: center;">{{$phieu->idve.date('ymd', strtotime($phieu->created_at))}}<a class="btn btn-primary" href="{{route('chitietve',$phieu->idve)}}"> <br>Xem chi tiết vé</a></th>
                      @endif
             
                    </td>
                    <td>{{$phieu->cmnd}}</td>
                    <td style="width: 120px;">{{$phieu->hoten}}</td>
                    <td>
                      @if($phieu->gioitinh == 1)
                      {{'Nam'}}
                      @else
                      {{'Nữ'}}
                      @endif
                    </td>
                    <td>{{$phieu->sdt}}</td>
                    <td>{{$phieu->soluong}}</td>
                    <td  style="width: 120px;">{{number_format($phieu->tongtien)}} VNĐ</td>
                    <td>
                      @if($phieu->trangthai == 0)
                      {{'Chờ thanh toán'}}
                      @elseif($phieu->trangthai == 1)
                      {{'Đã thanh toán'}}
                      @else
                      {{'Đã hủy'}}
                      @endif
                    </td>
                    <td>{{$phieu->diemdi}} - {{$phieu->diemden}}</td>        
                    <td>          
                      <a class="btn btn-success" href="{{route('capnhatve',$phieu->idve)}}"  class="active" ui-toggle-class="" 
                        onclick="return confirm('Bạn có chắc muốn cập nhật trạng thái này không')"> Cập nhật trạng thái
                    </td>
                  </tr>
                  @endforeach   
          </tbody>
          <tfoot>
            <tr>
              <th>Mã phiếu vé</th>
              <th>Chứng minh nhân dân</th>
              <th>Họ và tên</th>
              <th>Giới tính</th>
              <th>Số điện thoại</th>
              <th>Số lượng vé</th>
              <th>Tổng tiền</th>
              <th>Trạng thái</th>
              <th>Chuyến xe</th>
              <th >Thao tác</th>
             
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
 