@extends('layout_admin')
@section('content_admin')

<div class="market-updates">
    <div class="col-md-3 market-update-gd">
        <div class="market-update-block clr-block-2">
            <div class="col-md-4 market-update-right">
                <i class="fa fa-eye"> </i>
            </div>
             <div class="col-md-8 market-update-left">
             <h4>Số lượng xe</h4>
            <h3> <i style="font-size:14px;">Đang hoạt động:</i>{{count($xe_active)}} </h3>
            <h3> <i style="font-size:14px;">Đang bảo trì:</i>{{count($xe_unactive)}} </h3>
            {{-- <h3>{{count($xe_unactive)}}</h3>
            <p>Đang bảo trì</p> --}}
          </div>
          <div class="clearfix"> </div>
        </div>
    </div>
    <div class="col-md-3 market-update-gd">
        <div class="market-update-block clr-block-1">
            <div class="col-md-4 market-update-right">
                <i class="fa fa-users" ></i>
            </div>
            <div class="col-md-8 market-update-left">
            <h4>Khách hàng</h4>
            <h3> <i style="font-size:14px;">Đã đăng ký:</i> {{count($khachhang)}} </h3>
            <h3> <i style="font-size:14px;">Đã di chuyển:</i> {{count($nguoidi)}} </h3>

            </div>
          <div class="clearfix"> </div>
        </div>
    </div>
    <div class="col-md-3 market-update-gd">
        <div class="market-update-block clr-block-3">
            <div class="col-md-4 market-update-right">
                <i class="fa fa-usd"></i>
            </div>
            <div class="col-md-8 market-update-left">   
                <h4>Tổng doanh thu</h4>
                <h3>{{number_format($tongtien)}} VND </h3>

            </div>
          <div class="clearfix"> </div>
        </div>
    </div>
    <div class="col-md-3 market-update-gd">
        <div class="market-update-block clr-block-4">
            <div class="col-md-4 market-update-right">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            </div>
            <div class="col-md-8 market-update-left">
                <h4>Tổng vé bán ra</h4>
                <h3> <i style="font-size:14px;">Đã bán ra:</i> {{count($nguoidi)}} </h3>
                <h3> <i style="font-size:14px;">Đã hủy vé:</i> {{count($ve_huy)}} </h3>
            </div>
          <div class="clearfix"> </div>
        </div>
    </div>
   <div class="clearfix"> </div>
</div>
<!--main content start-->
{{-- <div id="myfirstchart" style="height: 250px;"></div> --}}
<script>
    $(document).ready( function () {

$('#btn-dashboard-fillter').click(function(){
    var _token=$('input[name="_token"]').val();
  var from_date=$('#datepicker').val();
  var to_date=$('#datepicker2').val();
$.ajax({
    url:"{{url('/fillterByDate')}}",
    method:"POST",
    dataType:"JSON",
    data:{from_date:from_date,to_date:to_date,_token:_token},

    success:function(data){
        chart.setData(data);
     
    }
});
});

$( function() {
$( "#datepicker" ).datepicker({
    prevText:"Tháng trước",
    nextText:"Tháng sau",
    dateFormat:"yy-mm-dd",
    dayNamesMin:["Thứ 2","Thứ 3","Thứ 4","Thứ 5","Thứ 6","Thứ 7","Chủ nhật ",],
    duration:"slow"
});
$( "#datepicker2" ).datepicker({
    prevText:"Tháng trước",
    nextText:"Tháng sau",
    dateFormat:"yy-mm-dd",
    dayNamesMin:["Thứ 2","Thứ 3","Thứ 4","Thứ 5","Thứ 6","Thứ 7","Chủ nhật ",],
    duration:"slow"
});
});

$('.dashboard-filter').change(function(){
var dashboard_value=$(this).val();
var _token=$('input[name="_token"]').val();

// alert(dashboard_value);
$.ajax({
    url:"{{url('/dashboardFillter')}}",
    method:"POST",
    dataType:"JSON",
    data:{dashboard_value:dashboard_value,_token:_token},

    success:function(data){
        chart.setData(data);
     
    }
});
});
chart7daysorder();
var chart =new Morris.Bar({

element: 'chart',
lineColor:['#000000','#ffffff'],
parseTime:false,
hideHover:'aotu',
//   data: [
//     { ngay: '2008', value: 20 },
//     { year: '2009', value: 10 },
//     { year: '2010', value: 5 },
//     { year: '2011', value: 5 },
//     { year: '2012', value: 20 }

//   ],

//   xkey: 'year',
//   ykeys: ['value'],
//   labels: ['Value']

xkey: 'ngay',
ykeys: ['tongtien','soluong'],
labels: ['Tổng Doanh Thu','Số đơn hàng']
});
function chart7daysorder(){
var _token=$('input[name="_token"]').val();
$.ajax({
    url:"{{url('/show7day')}}",
    method:"POST",
    dataType:"JSON",
    data:{_token:_token},

    success:function(data){
        chart.setData(data);
     
    }
});
}
} );
</script>
<div class="col-md-12">
    <div id="chart" style="height: 250px;"></div>
</div>
<form autocomplete="off">
    @csrf
<div class="col-md-2">
    
    <p>Từ Ngày: <input type="date" id="datepicker" class="form-control"> </p>
    <input type="button"  id="btn-dashboard-fillter" class="btn btn-primary btn-sm" value="Lọc kết quả"></p>
</div>

<div class="col-md-2">
    <p>Đến Ngày: <input type="date" id="datepicker2"  class="form-control"></p>
</div>
<div class="col-md-2">
{{-- <p>
    Lọc Theo: 
    <select class="dashboard-filter form-control">
    <option>---Chọn---</option>
    <option value="7ngay">7 Ngày Qua</option>
    <option value="thangtruoc">Tháng Trước</option>
    <option value="thangnay">Tháng Này</option>
    <option value="365ngayqua">365 Ngày Qua</option>
    </select>
</p> --}}

</div>
</form>

@endsection