@extends('layout_admin')
@section('content_admin')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Danh sách tuyến xe
      </div>
     
      <div class="row w3-res-tb">
        <button style="float:right;margin-bottom: 10px;" type="button" class="btn btn-primary fa fa-road" data-toggle="modal" data-target="#exampleModal" data-whatever="">Thêm tuyến xe</button>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h2 class="panel-heading">
                    Thêm lộ trình
                </h2>
                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span> --}}
                </button>
              </div>
              <div class="modal-body">
                <form role="form" action="{{URL::to('/themtuyenxe')}}" method="POST" enctype="multipart/form-data">
                  {{csrf_field()}}
              <div class="form-group">
                  <label for="exampleInputEmail1">Điểm đi</label>
                  <input type="text" class="form-control" id="diemdi" name="diemdi" placeholder="Nhập điểm đi" value="{{old('bienso')}}">
                  <span class="error-message">{{ $errors->first('diemdi') }}</span>
              </div>
              <div class="form-group">
                  <label for="exampleInputPassword1">Điểm đến</label>
                  <input type="text" class="form-control" id="diemden" name="diemden" placeholder="Nhập điểm đến">
                  <span class="error-message">{{ $errors->first('diemden') }}</span>
              </div>
          
          
              <div class="form-group">
                  <label for="inputName">Hình ảnh</label>
                  <input type="file" id="hinhanh" name="hinhanh" class="form-control" placeholder="Chọn hình">
                  <span class="error-message">{{ $errors->first('hinhanh') }}</span>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Đơn giá</label>
                  <input type="text" class="form-control" id="dongia" name="dongia" placeholder="Nhập giá tiền" value="{{old('dongia')}}">
                  <span class="error-message">{{ $errors->first('dongia') }}</span>
              </div>
                  
  
              <div class="form-group">
                 <a href="{{URL::to('danhsachtuyenxe')}}" class="btn btn-secondary">Trở về</a>           
            <button id="btn-luu" name="btn-luu" class="btn btn-success float-right"> Lưu
            </button>
            </div>
          </form>
              </div>
             
            </div>
          </div>
        </div>
      </div>
      {{-- <div> <a href="{{('themxe')}}"><button style="float:right;" class="btn btn-primary">Thêm mới</button></a></div> --}}
     
      <div class="table-responsive">
        @if(session('thongbao'))
        <div class="alert alert-info text-center">
            {{session('thongbao')}}
        </div>
        @endif
        <table id="example1" class="table-bordered table-striped table-hover" style="width: 100%;">
          <thead>
            <tr>
                    <th>Mã tuyến</th>
                    <th>Điểm đi</th>
                    <th>Điểm đến</th>
                    <th>Hình ảnh</th>
                    <th>Đơn giá ( VNĐ )</th>
                    <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($tuyenxe as $tx)  
            <tr>
              <th scope="row">{{$tx->idtuyenxe}}</th>
              <td>{{$tx->diemdi}}</td>
              <td>{{$tx->diemden}}</td>
              <td >
                <img  width="120px" height="120px" src="images/anhtuyenxe/{{$tx->hinhanh}}">
              </td>
              <td>{{number_format($tx->dongia)}}</td>
              <td>
                <a href="{{URL::to('suatuyenxe/'.$tx->idtuyenxe)}}" class="active" ui-toggle-class=""><i class="fa-pencil-styling fa fa fa-pencil-square-o  text-success text-active"></i>
                </a>
                <a href="{{URL::to('xoatuyenxe/'.$tx->idtuyenxe)}}"><i class="delete fa-trash-styling fa fa-trash text-danger text" id="deleteXe" data-id="{{$tx->idtuyenxe}}"></i></a>
              </td>
            </tr>
            @endforeach       
          </tbody>
          <tfoot>
            <tr>
              <th>Mã tuyến xe</th>
              <th>Điểm đi</th>
              <th>Điểm đến</th>
              <th>Hình ảnh</th>
              <th>Đơn giá</th>
              <th>Action</th>
            </tr>
            </tfoot>
        </table>
      </div>
      <footer class="panel-footer">
      </footer>
    </div>
  </div>

<script>
    $(function () {
    $("#example1").DataTable({
      "responsive": true, // tương thích vs các thiết bị
      "autoWidth": true, // thay đổi độ rộng thông minh
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
<script>
$(document).ready(function(){
// Delete 
$('.delete').click(function(){
  var el = this;
  // Delete id
  var deleteid = $(this).data('idtuyenxe');
  var confirmalert = confirm("Bạn có chắc muốn xóa?");
  if (confirmalert == true) {
     // AJAX Request
     $.ajax({
       url: 'danhsachtuyenxe.blade.php',
       type: 'POST',
       data: { id:deleteid },
       success: function(response){

         if(response == 1){
     // Remove row from HTML Table
     $(el).closest('tr').css('background','tomato');
     $(el).closest('tr').fadeOut(800,function(){
        $(this).remove();
     });
         }else{
     alert('Invalid ID.');
         }
       }
     });
  }
 else{
       return false;
   }
});
});
$('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) 
  var recipient = button.data('whatever')  
})
    </script>
@endsection
<style type="text/css">
        /* màu hiển thị lỗi*/
        .error-message { color: red; }
 </style>
 