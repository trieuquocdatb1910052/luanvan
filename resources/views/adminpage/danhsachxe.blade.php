
@extends('layout_admin')
@section('content_admin')

<div class="table-agile-info"> 
    <div class="panel panel-default">
      <div class="panel-heading">
        Danh sách thông tin xe
      </div>
      <div class="col">
        <a href="{{URL::to('xuatExcel')}}" class="btn btn-sm btn-primary">Export Excel</a>
      </div>
      <div class="row w3-res-tb">
        <button style="float: right; margin-bottom: 10px;" type="button" class="btn btn-primary fa fa-car" data-toggle="modal" data-target="#exampleModal" data-whatever="">Thêm xe mới</button>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h2 class="panel-heading">
                    Thêm thông tin xe   
                </h2>
                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span> --}}
                </button>
              </div>
              <div class="modal-body">
                <form role="form" action="{{URL::to('/themxe')}}" method="POST" enctype="multipart/form-data">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Biển số</label>
                        <input type="text" class="form-control" id="bienso" name="bienso" placeholder="Nhập biển số xe" value="{{old('bienso')}}">
                        <span class="error-message">{{ $errors->first('bienso') }}</span>
                    </div>
        
                    <div class="form-group">
                        <label for="exampleInputPassword1">Số lượng ghế</label>
                        <input type="text" class="form-control" id="soghe" name="soghe" placeholder="Nhập số lượng ghế">
                        <span class="error-message">{{ $errors->first('soghe') }}</span>
                    </div>
        
                  <div class="form-group">
                    <label for="exampleInputPassword1">Chọn loại xe</label>
                    <select class="form-control" name="loaixe">                            
                          <option value="0">Ghế ngồi</option>
                          <option value="1">Giường nằm</option>
                          <span class="error-message">{{ $errors->first('loaixe') }}</span>  
                    </select>         
                  </div>
                  
                  <div class="form-group">
                    <label for="inputName">Hình xe</label>
                    <input type="file" id="hinhxe" name="hinhxe" class="form-control" placeholder="Chọn hình xe">
                    <span class="error-message">{{ $errors->first('hinhxe') }}</span>
                  </div>
        
                  <div class="modal-footer">
                    <a href="" class="btn btn-secondary" data-dismiss="modal">Trở về</a>     
                     
                <button id="btn-luu" name="btn-luu" class="btn btn-primary"> Lưu
                </button>
             </div>
                </form>
              </div>
             
            </div>
          </div>
        </div>

        {{-- <a href="{{URL::to('/themxe')}}"><button style="float:right;" class="btn btn-primary">Thêm xe mới </button></a> --}}
      </div>
    
     <div id="notifDiv"></div>
      <div class="table-responsive">
        @if(session('thongbao'))
        <div class="alert alert-info text-center">
            {{session('thongbao')}}
        </div>
        @endif
        <table id="example1" class=" table-bordered table-striped table-hover" style="width: 100%;">
          <thead>
            <tr class="table-secondary" id="list-header">
                    <th>Mã xe</th>
                    <th>Biển số</th>
                    <th>Số ghế</th>
                    <th>Loại xe</th>
                    <th>Hình xe</th>
                    <th>Tình trạng</th>
                    <th>Action</th>
              {{-- <th style="width:80px;"></th> --}}
            </tr>
          </thead>
          <tbody>
            @foreach($xe as $x) 
            <tr>
              <th>{{$x->idxe}}</th>
              <td>{{$x->bienso}}</td>
              <td>{{$x->soghe}}</td>
              <td >
                @if($x->loaixe == 0)
                {{'Ghế ngồi'}}
                @else
                {{'Giường nằm'}}
                @endif
              </td>
              <td >
                <img  width="100px" src="images/anhxe/{{$x->hinhxe}}">
              </td>
              <td>
                <input data-id="{{$x->idxe}}" value="{{$x->idxe}}" class="toggle-class" type="checkbox" data-onstyle="success" datastyle="slow"
                data-offstyle="danger" data-toggle="toggle" data-on="Đang hoạt động" data-off="Bảo trì"
                {{ $x->trangthai ? 'checked' : '' }}>
              </td>
              <td>
                <a href="{{URL::to('suaxe/'.$x->idxe)}}" class="active" ui-toggle-class=""><i class="fa-pencil-styling fa fa fa-pencil-square-o  text-success text-active"></i>
                </a>
                <a href="{{URL::to('xoaxe/'.$x->idxe)}}"><i class="delete fa-trash-styling fa fa-trash text-danger text" id="deleteXe" data-id="{{$x->idxe}}"></i></a>
              </td>
            </tr>
            @endforeach    
          </tbody>
          <tfoot>
            <tr>
              <th>Mã xe</th>
              <th>Biển số</th>
              <th>Số ghế</th>
              <th>Loại xe</th>
              <th>Hình xe</th>
              <th>Tình trạng</th>
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
        $('.toggle-class').change(function() {
        var trangthai = $(this).prop('checked') == true ? 1 : 0;
        var idxe = $(this).data('id');
        // alert(idxe);
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '/changeStatus',
                data: {
                  'trangthai': trangthai,
                 'idxe': idxe
                 },
                success: function(data){
                    $('#notifDiv').fadeIn();
                    $('').css('background','green');
                    $('#notifDiv').text('Thay đổi trạng thái thành công');
                    setTimeout(() =>
                    {
                      $('#notifDiv').fadeOut();
                    },3000);
                }
            });
        
        });
</script>
 
<script src="{{asset('frontend/js/js_admin/datatable.js')}}"></script>
@endsection
<style type="text/css"> 
        /* màu hiển thị lỗi*/
        .error-message { color: red; }
 </style>
 