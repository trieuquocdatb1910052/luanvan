@extends('layout_admin')
@section('content_admin')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Danh sách chuyến xe
      </div>
     
      <div class="row w3-res-tb">
           
        <a href="{{URL::to('/themchuyenxe')}}"><button style="float:right;margin-bottom: 10px;" class="btn btn-primary fa fa-calendar">Thêm chuyến xe</button></a>
      </div>
      <div class="table-responsive">
        @if(session('thongbao'))
        <div class="alert alert-info text-center">
            {{session('thongbao')}}
        </div>
        @endif
        <table id="example1" class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
                    <th>STT</th>
                    <th>Mã chuyến xe</th>
                    <th>Tuyến xe</th>
                    <th>Biển số xe</th>
                    <th>Giờ đi</th>
                    <th>Giờ đến</th>
                    <th>Ngày đi</th>
                    <th>Ngày đến</th>
                    <th>Nơi xuất bến</th>
                    <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              {{-- <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td> --}}
              @foreach($chuyenxe as $cx)  
              <th scope="row">{{$cx->stt}}</th>
              <td>{{$cx->idchuyenxe}}</td>
              <td>{{$cx->diemdi}} - {{$cx->diemden}}</td>
              <td>{{$cx->bienso}}</td>
              <td>{{$cx->giodi}}</td>
              <td>{{$cx->gioden}}</td>
              <td>{{date('d-m-Y', strtotime($cx->ngaydi))
              }}</td>
              <td>{{date('d-m-Y', strtotime($cx->ngayden))
              }}</td>
              <td>{{$cx->noixuatben}}</td>
              <td>
                <a href="{{URL::to('suachuyenxe/'.$cx->idchuyenxe)}}" class="active" ui-toggle-class=""><i class="fa-pencil-styling fa fa fa-pencil-square-o  text-success text-active"></i>
                </a>
                <a href="{{URL::to('xoachuyenxe/'.$cx->idchuyenxe)}}"  onclick="return confirm('Bạn có chắc muốn xóa?')"><i class="delete fa-trash-styling fa fa-trash text-danger text" id="delete" data-id="{{$cx->idxe}}"></i></a>
              </td>
            </tr>
            @endforeach       
          </tbody>
          <tfoot>
            <tr>
              <th>STT</th>
              <th>Mã chuyến xe</th>
              <th>Tuyến xe</th>
              <th>Biển số xe</th>
              <th>Giờ đi</th>
              <th>Giờ đến</th>
              <th>Ngày đi</th>
              <th>Ngày đến</th>
              <th>Nơi xuất bến</th>
              <th>Action</th>
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
 