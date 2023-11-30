@extends('layout_admin')
@section('content_admin')

<div class="table-responsive">
  @if(session('thongbao'))
  <div class="alert alert-info text-center">
      {{session('thongbao')}}
  </div>
  @endif
  <table id="demo_table" class="table table-bordered table-hover">
    <thead>
      <tr>
              <th>Mã xe</th>
              <th>Biển số</th>
              <th>Số ghế</th>
              <th>Hình ảnh</th>
       
        <th style="width:80px;"></th>
      </tr>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
      <tr>
        <th>Mã xe</th>
        <th>Biển số</th>
        <th>Số ghế</th>
        <th>Hình ảnh</th>

      </tr>
      </tfoot>
  </table>
</div>

<script>
  $(document).ready( function () { $('#demo_table').DataTable({ "processing": false, "serverSide": true, "ajax": '{{ route('ajax.posts.index') }}', "columns": [ { "data": "idtuyenxe" }, { "data": "diemdi" }, { "data": "diemden" }, { "data": "dongia" },{ "data": "hinhanh" } ] });
} );
</script>
@endsection
