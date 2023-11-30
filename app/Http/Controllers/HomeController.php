<?php

namespace App\Http\Controllers;

use Yajra\DataTables\DataTables;
use App\Models\TuyenXe;
use App\Models\UserLVTN;
use App\Models\Chuyenxe;
use App\Models\Ve;
use App\Models\NguoiDi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class HomeController extends Controller
{
    //Test
    public function test(){

        
        return view('customerpage.thongtinkhachhang');

        
    }

    public function getIndex(){
        $diemdi = DB::table('tuyenxe')->select('diemdi')->distinct()->get();
        $hinhanh = DB::table('tuyenxe')->select('hinhanh')->distinct()->get();
        $diemden = DB::table('tuyenxe')->select('diemden')->distinct()->get();
        $tuyenxe      = DB::table('tuyenxe')->get();
        $chuyenxe     = DB::table('chuyenxe')->get();
        return view('customerpage.index', compact('diemdi','diemden','tuyenxe','chuyenxe','hinhanh'));
    }
    public function getGioiThieu(){
        
        return view('customerpage.gioithieu');
    }
    public function getLienHe(){
        
        return view('customerpage.lienhe');
    }

    //Giao diện đăng ký khách hàng
    public function getDangKy(){
        return view('customerpage.dangky');
    }
    
    //Xử lý đăng ký khách hàng
    public function postDangKy(Request $req)
    {
        $this->validate($req,
        [
            'tentaikhoan'          => 'required|min:5|max:35|unique:users,tentaikhoan',
            'password'             => 'required|min:5|max:20',
            're_password'          => 'required|same:password',
            'sdt'                  => 'required|numeric',
            'email'                => 'required|email|unique:users,email',
            'hoten'                => 'required|min:5|max:25',
            'diachi'               => 'required|min:10|max:100',
        ],
        [
            'email.required'       => ' Bạn chưa nhập email.',
            'email.email'          => 'Email không đúng định dạng',
            'email.unique'         => 'Email đã có người sử dụng',
            'password.required'    => 'Bạn nhập mật khẩu.',
            'password.min'         => 'Mật khẩu ít nhất 5 ký tự.',
            'password.max'         => 'Mật khẩu nhiều nhất 20 ký tự.',
            're_password.required' => 'Bạn chưa xác nhận lại mật khẩu.',
            're_password.same'     => 'Mật khẩu không trùng nhau.',
            'tentaikhoan.required' => 'Bạn chưa nhập tên tài khoản.',
            'tentaikhoan.unique'   => 'Tên tài khoản đã có người sử dụng',
            'tentaikhoan.min'      => 'Tên tài khoản ít nhất 5 ký tự.',
            'tentaikhoan.max'      => 'Tên tài khoản nhiều nhất 35 ký tự.',
            'hoten.required'       => 'Bạn chưa nhập họ tên .',
            'hoten.min'            => 'Họ tên trên 5 ký tự.',
            'diachi.required'      => 'Bạn chưa nhập địa chỉ.',
            'diachi.min'           => 'Địa chỉ ít nhất 10 ký tự.',
            'diachi.max'           => 'Địa chỉ nhiều nhất 40 ký tự.',
            'sdt.required'         => 'Bạn phải nhập số điện thoại',
            'sdt.numeric'          => 'Số điện thoại phải là số',
        ]);
        $data = $req->all();
        $user              = new UserLVTN();
        $user->tentaikhoan = $req->tentaikhoan;
        $user->password    = Hash::make($req->password);
        // $user->password=bcrypt($data['password']);
        $user->sdt         = $req->sdt;
        $user->email       = $req->email;
        $user->hoten       = $req->hoten;
        $user->gioitinh    = $req->gioitinh;
        $user->diachi      = $req->diachi;
        $user->trangthai   =0;
        $user->level       =1;
        $user->save();
        
        //Send mail confirm register
        $email = $data['email'];
        $messageData=[
            'email' => $data['email'],
            'hoten' => $data['hoten'],
            'code' => base64_encode($data['email']), // phuc vu cho viec luu tru
        ];
        // dd($messageData);
        Mail::send('customerpage.confirm_register',$messageData,function($message)use($email){
            $message->to($email)->subject('Xác nhận đăng ký tài khoản tại LIFE-Website');
        });
        // $req->session()->forget('thanhcong_mail');
        // // Session::put('thanhcong_mail','Vui lòng kiểm tra email của bạn để hoàn tất việc đăng ký tài khoản');
        return redirect('dangnhap')->with('thanhcong_mail', 'Vui lòng kiểm tra email của bạn để hoàn tất việc đăng ký tài khoản');
    }

    /* Giao diện đăng nhập */
    public function getDangNhap(){
        return view('customerpage.dangnhap');
    }


    /* Xử lý đăng nhập */
    public function postDangNhap(Request $req){
        $this->validate($req,
        [
            'tentaikhoan' => 'required|min:5|max:35',
            'password'    => 'required|min:5|max:20',
        ],
        [

            'tentaikhoan.required' => 'Bạn chưa nhập tên tài khoản.',
            'tentaikhoan.min'      => 'Tên tài khoản ít nhất 5 ký tự.',
            'tentaikhoan.max'      => 'Tên tài khoản nhiều nhất 25 ký tự.',
            'password.required'    => 'Vui lòng nhập mật khẩu',
            'password.min'         => 'Mật khẩu ít nhất 5 kí tự',
            'password.max'         => 'Mật khẩu không quá 20 kí tự',
        ]); 

    if (Auth::attempt(['tentaikhoan' => $req->tentaikhoan, 'password' => $req->password])) {
        $taikhoanbicam = DB::table('users')->where('tentaikhoan', $req->tentaikhoan)->first();
        if ($taikhoanbicam->trangthai == -1) 
        {
            return redirect()->back()->with(['thongbaokhoa' => 'Đăng nhập không thành công, tài khoản này đã bị cấm, vì lý do: ' . $taikhoanbicam->lydo]);
        }
        else if($taikhoanbicam->trangthai == 0)
        {
            return redirect()->back()->with(['waiting_active' => 'Tài khoản của bạn chưa được kích hoạt, vui lòng xác nhận mail để hoàn tất việc đăng ký!!!!']);
        } 
        else if($taikhoanbicam->trangthai==1)
        {
            $req->session()->put('data', $req->input());
            return redirect('')->with('thanhcong', 'Bạn đã đăng nhập thành công');
        }
    }
    else 
    {
    return redirect()->back()->with(['message' => 'Sai tài khoản mật hoặc khẩu']);        
    }
}
    public function getChuyenXe($id,Request $request){
        $time     = now()->toDateString('Y-m-d');
        $time1    = now()->toTimeString();
        $chuyenxe = DB::table('chuyenxe')
            ->join("xe", "chuyenxe.idxe", "=", "xe.idxe")
            ->where('idtuyenxe', $id)
            ->where('ngaydi', '=', $time)
            ->where('giodi', '>', $time1)
            ->get();
        $tuyenxe      = DB::table('tuyenxe')->where('idtuyenxe', $id)->first();
        $diemkhoihanh = DB::table('tuyenxe')->select('diemdi')->distinct()->get();
        $diemden = DB::table('tuyenxe')->select('diemden')->distinct()->get();
        $now          = Carbon::now('Asia/Ho_Chi_Minh');
        foreach ($chuyenxe as $chuyen) {
            $tongve = DB::table('ve')
                ->join('chuyenxe', 'chuyenxe.idchuyenxe', '=', 've.idchuyenxe')
                ->where('ve.idchuyenxe', $chuyen->idchuyenxe)
                ->sum('soluong');
            $chuyen->soghe = $chuyen->soghe - $tongve;
        }
        return view('customerpage.chuyenxe', compact('time', 'time1', 'chuyenxe', 'tuyenxe', 'diemkhoihanh', 'now','diemden'));
    }

     /*Giao dien thong tin KH*/
    public function getSuaThongTinKH($id)
    {
        $taikhoan = DB::table('users')->where('tentaikhoan', $id)->first();
        
        return view('customerpage.thongtinkhachhang', compact('taikhoan'));
    }

     /*Xử lý thay đổi thông tin KH*/
    public function postSuaThongTinKH(Request $req,$id)
    {
        $this->validate($req,
        [
            'email'  => 'email',
            'cmnd'   => 'numeric|digits_between:9,15',
            'sdt'    => 'regex:/(0)[0-9]{9}/',
        ],
        [
            'cmnd.digits_between'=>'CMND phải từ 9 tới 15 chữ số',
            'email.email'     => 'Email không đúng định dạng',
            'cmnd.numeric'    => 'Chứng minh nhân dân và thẻ căn cước chỉ được số',
            'sdt.regex'       => 'Số điện thoại phải bắt đầu từ số 0 và quy định bởi 10 số',
        ]);   
        $taikhoan = DB::table('users')->where('tentaikhoan', $id)->first();
        // dd($taikhoan);
        $data['hoten']     = $req->hoten;
        $data['email']    = $req->email;
        $data['gioitinh'] = $req->gioitinh;
        $data['cmnd']     = $req->cmnd;
        $data['sdt']      = $req->sdt;
        $data['diachi']   = $req->diachi;
        DB::table('users')->where('tentaikhoan', $id)->update($data);      
        // dd($taikhoan);
        return redirect('thongtinkh/'.$id)->with('thanhcong', 'Cập nhập thông tin thành công !');   
    }

    /*Dang xuat khach hang*/
    public function getDangXuat()
    {
        session()->forget('data'); //Hủy bỏ session
        session()->forget('hoten1');
        return redirect('');
    }
  
    /*Giao dien doi mat khau*/ 
    public function getDoiMatKhauKH($id){
        $taikhoan = DB::table('users')->where('tentaikhoan', $id)->first();
        return view('customerpage.doimatkhau', compact('taikhoan'));
    }

    /*Xu ly doi password*/
    public function postDoiMatKhauKH(Request $req,$id){
        $this->validate($req,
        [
            'password'  => 'required',
            'password1' => 'required',
            'password2' => 'required|same:password1',
        ],
        [
            'password.required'  => 'Nhập mật khẩu cũ',
            'password1.required' => ' Nhập mật khẩu mới',
            'password2.required' => ' Nhập lại mật khẩu mới',
            'password2.same'     => 'Không trùng với mật khẩu mới',
        ]);
        if (Auth::attempt(['tentaikhoan' => $id, 'password' => $req->password])) {
            $taikhoan = DB::table('users')->where('tentaikhoan', $id)->update(['password' => Hash::make($req->password1)]);
            session()->forget('data');
            return redirect('dangnhap')->with('thanhcong', 'Đổi mật khẩu thành công, quý khách vui lòng đăng nhập lại');
        } else {
            return redirect()->back()->with('thongbao', 'Mật khẩu cũ sai, vui lòng nhập lại');
        }
    }
    
    public function getTimkiemchuyenxe(Request $req)
    { 
        $now    = Carbon::now('Asia/Ho_Chi_Minh');
       
        $ngaydi=$req->ngaydi;

        $time   = now()->toDateString('Y-m-d');
      
        if($req->diemden == $req->diemdi)
        {
            return redirect()->back()->with('thongbao', 'Địa điểm không được trùng nhau');
        }
        if($ngaydi <  $time && $ngaydi != null)
       {
           return redirect()->back()->with('thongbao', 'Địa điểm không được trùng nhau');
       }
        $giodi =now()->toTimeString();
        $giohientai =now()->toTimeString();
        $diemkhoihanh = DB::table('tuyenxe')->select('diemdi')->distinct()->get();
        $diemden = DB::table('tuyenxe')->select('diemden')->distinct()->get();
        $ngayhientai =  (Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d'));
       
      if($ngaydi!=null )
       {      
        if($ngayhientai == $ngaydi)
         {
         $chuyenxe=DB::table('chuyenxe')->join('tuyenxe','tuyenxe.idtuyenxe','=','chuyenxe.idtuyenxe')->join("xe", "chuyenxe.idxe", "=", "xe.idxe")->where('tuyenxe.diemdi','like','%'.$req->diemdi.'%')
        ->where('tuyenxe.diemden','like','%'.$req->diemden.'%')->where('chuyenxe.ngaydi','=',$ngaydi)->where('giodi', '>', $giohientai)
        ->get();
        if(count($chuyenxe)==0) // trong ngày đi không có chuyến 
        {
            $chuyenxe=DB::table('chuyenxe')->join('tuyenxe','tuyenxe.idtuyenxe','=','chuyenxe.idtuyenxe')->join("xe", "chuyenxe.idxe", "=", "xe.idxe")->where('tuyenxe.diemdi','like','%'.$req->diemdi.'%')
            ->where('tuyenxe.diemden','like','%'.$req->diemden.'%')->where('chuyenxe.ngaydi','>=',$ngaydi)
            ->get();          
        }      
    }   
    else if($ngayhientai < $ngaydi)
    {
        $chuyenxe=DB::table('chuyenxe')->join('tuyenxe','tuyenxe.idtuyenxe','=','chuyenxe.idtuyenxe')->join("xe", "chuyenxe.idxe", "=", "xe.idxe")->where('tuyenxe.diemdi','like','%'.$req->diemdi.'%')
        ->where('tuyenxe.diemden','like','%'.$req->diemden.'%')->where('chuyenxe.ngaydi','>=',$ngaydi)
        ->get();
   
    }      
        foreach($chuyenxe as $chuyen)
            {       
                $tongve = DB::table('ve')
                ->join('chuyenxe', 'chuyenxe.idchuyenxe', '=', 've.idchuyenxe')
                ->where('ve.idchuyenxe', $chuyen->idchuyenxe)
                ->sum('soluong');
                 $chuyen->soghe = $chuyen->soghe - $tongve;          
            }           
            return view('customerpage.timkiemchuyenxe', compact('time', 'chuyenxe',  'diemkhoihanh', 'now','diemden'));
        }   
        else
        {    
            $chuyenxe=DB::table('chuyenxe')->join('tuyenxe','tuyenxe.idtuyenxe','=','chuyenxe.idtuyenxe')->join("xe", "chuyenxe.idxe", "=", "xe.idxe")
            ->where('tuyenxe.diemdi','like','%'.$req->diemdi.'%')->where('tuyenxe.diemden','like','%'.$req->diemden.'%')
            ->where('chuyenxe.ngaydi','=',$ngayhientai)->where('giodi', '>', $giohientai)->orWhere('chuyenxe.ngaydi','>',$ngayhientai)
            ->where('tuyenxe.diemdi','like','%'.$req->diemdi.'%')->where('tuyenxe.diemden','like','%'.$req->diemden.'%')->get();     

            foreach($chuyenxe as $chuyen)
            {
             $tongve = DB::table('ve')
                ->join('chuyenxe', 'chuyenxe.idchuyenxe', '=', 've.idchuyenxe')
                ->where('ve.idchuyenxe', $chuyen->idchuyenxe)
                ->sum('soluong');
                 $chuyen->soghe = $chuyen->soghe - $tongve;         
            }           
            // dd($chuyenxe);
            return view('customerpage.timkiemchuyenxe', compact('time', 'chuyenxe', 'diemkhoihanh', 'now','diemden'));
        }    
    }
    public function getXemve()
    {
        $ngay = (Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d'));
        $gio =(Carbon::now('Asia/Ho_Chi_Minh')->format('H:i:s'));
       
        if (session()->has('data')) {
            $taikhoan = DB::table('users')->select('idtk')->where('tentaikhoan', session('data')['tentaikhoan'])->first();

            $vedahuy = DB::table('ve')->select('ve.created_at','ve.idve','ve.soluong','ve.tongtien','ve.trangthai')
            ->join('chuyenxe','chuyenxe.idchuyenxe','=','ve.idchuyenxe') 
            ->where('ve.idtk',$taikhoan->idtk)->where('trangthai','=',2)->get(); 
       
            $vedadat = DB::table('ve')->select('ve.created_at','ve.idve','ve.soluong','ve.tongtien','ve.trangthai','chuyenxe.ngaydi','chuyenxe.giodi')->join('chuyenxe','chuyenxe.idchuyenxe','=','ve.idchuyenxe')
             ->where('ve.idtk',$taikhoan->idtk)->where('trangthai','=',1)->where('ngaydi','>',$ngay)->orWhere('ngaydi','=',$ngay)->where('giodi','>',$gio)->where('trangthai','=',1)
             ->orWhere('trangthai','=',0)
             ->orWhere('trangthai','=',1)->where('ngaydi','<=',$ngay)->where('ngayden','>',$ngay)->where('giodi','<',$gio)
            ->get();

        // dd($vedadat);
            $vedahoanthanh = DB::table('ve')->select('ve.created_at','ve.idve','ve.soluong','ve.tongtien','ve.trangthai')->join('chuyenxe','chuyenxe.idchuyenxe','=','ve.idchuyenxe')
            ->where('ve.idtk',$taikhoan->idtk)->where('trangthai','=',1)
            ->where('ngayden','<=',$ngay)->get();
        // dd($test);
            $count = count($vedahuy)  +  count($vedadat)  + count($vedahoanthanh); 
            // lấy các đơn hang thuộc user
            //dd($ve);
            if($count >0) // có đơn hàng thì mới cho coi
            {           
                return view('customerpage.xemve',compact('count','vedahuy','vedadat','vedahoanthanh'));
            }
             else
            {
                return redirect()->back()->with('thongbao', 'Bạn không có vé để xem');
            }
        }      
    }
    public function getXemVe1(){
       return view('customerpage.xemve1');
    }

    public function getChitietveuser($idve)
    {
        
        $taikhoan = DB::table('users')->where('tentaikhoan', session('data')['tentaikhoan'])->first();
        if (session()->has('data')) {
        $ve = DB::table('ve')->join('nguoidi','nguoidi.idve','=','ve.idve')->join('chuyenxe','chuyenxe.idchuyenxe','=','ve.idchuyenxe')
        ->join('tuyenxe','tuyenxe.idtuyenxe','=','chuyenxe.idtuyenxe')->where('ve.idve','=',$idve)->get();
    //    dd($ve);  
         $stt=0;
         foreach ($ve as $v) {
            $stt         += 1;
            $v->stt = $stt;
        }
       return view('customerpage.xemchitietveuser',compact('ve','taikhoan'));
        }
    }
    public function getDatve($id)
    {
        if (session()->has('data')) {
        $thongtinchuyen = DB::table('chuyenxe')
        ->join('xe', 'chuyenxe.idxe', '=', 'xe.idxe')
        ->where('idchuyenxe', $id)
        ->first();
        $layghe = DB::table('nguoidi')->join('ve','ve.idve','=','nguoidi.idve')->join('chuyenxe','chuyenxe.idchuyenxe','=','ve.idchuyenxe') ->where('chuyenxe.idchuyenxe', $id)->get();
        if(count($layghe)<=0)
        {
            $tongve = DB::table('ve')
            ->join('chuyenxe', 'chuyenxe.idchuyenxe', '=', 've.idchuyenxe')
            ->where('ve.idchuyenxe', $id)
            ->sum('soluong');
            $tongghe=$thongtinchuyen->soghe;
        $soghe = $thongtinchuyen->soghe - $tongve;
            $cho=[];
            $taikhoan = DB::table('users')->where('tentaikhoan', session('data')['tentaikhoan'])->first();
            return view('customerpage.datve', compact('thongtinchuyen', 'tongve', 'soghe', 'taikhoan','cho','tongghe'));
        }
            foreach($layghe as $lay)   
            {
                $cho[]=$lay->chongoi;
            }
            $tongve = count($cho);
            $soghe = $thongtinchuyen->soghe - $tongve;
    $tongghe=$thongtinchuyen->soghe;
        $taikhoan = DB::table('users')->where('tentaikhoan', session('data')['tentaikhoan'])->first();
     
        return view('customerpage.datve', compact('thongtinchuyen', 'tongve', 'soghe', 'taikhoan','cho','tongghe'));
    }    
    }
    public function postDatve(Request $req, $id)
    {
       

        $time    = now()->toDateString('Y-m-d');
        $time1=now()->format('y') . now()->format('m').now()->format('d');
     
        $data   = $req->all();

        $this->validate($req,
            [
                'cmnd'=>'required|numeric|min:9|digits_between:9,15',
                'gioitinh' => 'required',
                'sdt'      => 'required|size:10|regex:/(0)[0-9]{9}/', // bắt đầu là số 0 chỉ dx từ 0-9 ,kèm theo 9 số phía sau
                'soluong'  => 'numeric',
  
            ],
            [
                'cmnd.required'=>'Bạn chưa nhập Căn cước công dân',
                'cmnd.numeric'=>'CMND phải là chữ số',
                'cmnd.digits_between'=>'CMND tối thiếu 9 và tối đa 15 chữ số',
                'sdt.required'    => 'Bạn chưa nhập số điện thoại ',
                'sdt.numeric'     => 'Số điện thoại chỉ chứa số',
                'sdt.regex'       => 'Số điện thoại phải bắt đầu từ số 0 và quy định bởi 10 số',
                'sdt.phone_number'=>'Đây thực sự là số điện thoại',
                'sdt.size'        => 'Độ dài của điện thoại chỉ được 10 số',
                'soluong.numeric' => 'Quý khách vui lòng thêm vé',
                
            ]);
            if($req->trangthai == 0 )
        {
            $taikhoan = DB::table('users')->select('idtk')->where('tentaikhoan', session('data')['tentaikhoan'])->first();
             $chuyenxe       = ChuyenXe::find($id);
             $thongtinchuyen = DB::table('chuyenxe')
                 ->join('tuyenxe', 'chuyenxe.idtuyenxe', '=', 'tuyenxe.idtuyenxe')
                 ->where('idchuyenxe', $id)
                 ->first();
             $thongtinve             = new Ve;
   
             $thongtinve->soluong    = $req->soluong;
             $thongtinve->hoten      = $req->hoten;
             $thongtinve->gioitinh   = $req->gioitinh;
             $thongtinve->cmnd       = $req->cmnd;
             $thongtinve->trangthai=0;
             $thongtinve->idtk=$taikhoan->idtk;
             $thongtinve->sdt        = $req->sdt;
             $thongtinve->tongtien   = $thongtinve->soluong * $thongtinchuyen->dongia;
             $thongtinve->idchuyenxe = $id;
             $thongtinve->save();
             $idve = $thongtinve->id;
             
       
             $data             = $req->all();
             $cmndnguoidis     = $data['cmndnguoidi'];
             $hotennguoidis    = $data['hotennguoidi'];
             $gioitinhnguoidis = $data['gioitinhnguoidi'];
             $sdtnguoidis      = $data['sdtnguoidi'];
             $chongoi=$data['chongoinguoidi'];
     
             foreach ($cmndnguoidis as $k => $v) 
             {
       
                 $cmndnguoidi     = $v;
                 $hotennguoidi    = $hotennguoidis[$k];
                 $gioitinhnguoidi = $gioitinhnguoidis[$k];
                 $sdtnguoidi      = $sdtnguoidis[$k];
                 $chongoinguoidi=$chongoi[$k];
   
                 //save tai day
                 $thongtinnguoidi                  = new NguoiDi;  
                 $thongtinnguoidi->cmndnguoidi     = $cmndnguoidi;
                 $thongtinnguoidi->chongoi=$chongoinguoidi;
                 $thongtinnguoidi->hotennguoidi    = $hotennguoidi;
                 $thongtinnguoidi->gioitinhnguoidi = $gioitinhnguoidi;
                 $thongtinnguoidi->sdtnguoidi      = $sdtnguoidi;
                 $thongtinnguoidi->idve            = $idve;
                 // $thongtinnguoidi->phonehidden = $sdtnguoidihidden;
                 $thongtinnguoidi->save();
            }
            return redirect('xemve1')->with('thongbao','Vé được đặt thành công, vui lòng đến quầy vé gần nhất để hoàn tất việc thanh toán, xin cảm ơn !');
        } 
        else
        {  $taikhoan = DB::table('users')->select('idtk')->where('tentaikhoan', session('data')['tentaikhoan'])->first();
            $chuyenxe       = ChuyenXe::find($id);
            $thongtinchuyen = DB::table('chuyenxe')
                ->join('tuyenxe', 'chuyenxe.idtuyenxe', '=', 'tuyenxe.idtuyenxe')
                ->where('idchuyenxe', $id)
                ->first();
            $thongtinve             = new Ve;
  
            $thongtinve->soluong    = $req->soluong;
            $thongtinve->hoten      = $req->hoten;
            $thongtinve->gioitinh   = $req->gioitinh;
            $thongtinve->cmnd       = $req->cmnd;
            $thongtinve->trangthai=0;
            $thongtinve->idtk=$taikhoan->idtk;
            $thongtinve->sdt        = $req->sdt;
            $thongtinve->tongtien   = $thongtinve->soluong * $thongtinchuyen->dongia;
            $thongtinve->idchuyenxe = $id;
            $thongtinve->save();
            $idve = $thongtinve->id;
            
      
            $data             = $req->all();
            $cmndnguoidis     = $data['cmndnguoidi'];
            $hotennguoidis    = $data['hotennguoidi'];
            $gioitinhnguoidis = $data['gioitinhnguoidi'];
            $sdtnguoidis      = $data['sdtnguoidi'];
            $chongoi=$data['chongoinguoidi'];
    
            foreach ($cmndnguoidis as $k => $v) 
            {
      
                $cmndnguoidi     = $v;
                $hotennguoidi    = $hotennguoidis[$k];
                $gioitinhnguoidi = $gioitinhnguoidis[$k];
                $sdtnguoidi      = $sdtnguoidis[$k];
                $chongoinguoidi=$chongoi[$k];
  
                //save tai day
                $thongtinnguoidi                  = new NguoiDi;  
                $thongtinnguoidi->cmndnguoidi     = $cmndnguoidi;
                $thongtinnguoidi->chongoi=$chongoinguoidi;
                $thongtinnguoidi->hotennguoidi    = $hotennguoidi;
                $thongtinnguoidi->gioitinhnguoidi = $gioitinhnguoidi;
                $thongtinnguoidi->sdtnguoidi      = $sdtnguoidi;
                $thongtinnguoidi->idve            = $idve;
                // $thongtinnguoidi->phonehidden = $sdtnguoidihidden;
                $thongtinnguoidi->save();
           }
            $tongtien = $thongtinve->tongtien;
            return view('customerpage.indexvnpay',compact('tongtien','idve'));
        }
       
    }
    public function getHuyve($id)
    {
        $ve =DB::table('ve')->join('chuyenxe','chuyenxe.idchuyenxe','=','ve.idchuyenxe')->where('ve.idve','=',$id)->first();

        $laygio =Carbon::parse($ve->created_at)->addHour(1)->format('H:i:s');
  
        $layngay =Carbon::parse($ve->created_at)->format('Y-m-d');

        // dd($ve->created_at);
        if($ve->trangthai==0)
        {     
                Ve::where('idve','=',$id)->update(['trangthai' => 2]);
                return redirect()->back()->with('thanhcong', 'Bạn đã hủy vé thành công');
        }
        if($ve->trangthai==1)
        {
            if($laygio <= $ve->giodi && $layngay<= $ve->ngaydi)
            {
                
                Ve::where('idve','=',$id)->update(['trangthai' => 2]);
                return redirect()->back()->with('thanhcong', 'Bạn đã hủy vé thành công');
            }
           
        }
        return redirect()->with('thanhcong', 'Hủy vé thất bại');
    
    }
    public function getThanhtoan($id)
    {
        $ve =DB::table('ve')->join('chuyenxe','chuyenxe.idchuyenxe','=','ve.idchuyenxe')
        ->join('tuyenxe','tuyenxe.idtuyenxe','=','chuyenxe.idtuyenxe')->where('ve.idve','=',$id)->first();

        
        $tongtien=$ve->tongtien;
        $idve=$ve->idve;
        return view('customerpage.indexvnpay',compact('tongtien','idve'));
    }

    public function createPayment(Request $request)
    {
        
        $vnp_TmnCode = "UDOPNWS1"; //Mã website tại VNPAY 
        $vnp_HashSecret = "EBAHADUGCOEWYXCMYZRMTMLSHGKNRPBN"; //Chuỗi bí mật
        $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('payment.return',['idve'=>$request->idve]);
        $vnp_TxnRef = date("YmdHis"); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = "Thanh toán ";
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $request->amount*100;
        $vnp_Locale = 'vn';
        $vnp_IpAddr = request()->ip();

        $inputData = array(
            "vnp_Version" => "2.0.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . $key . "=" . $value;
            } else {
                $hashdata .= $key . "=" . $value;
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
           // $vnpSecureHash = md5($vnp_HashSecret . $hashdata);
            $vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashdata);
            $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
        }
        return redirect($vnp_Url);
    }

    public function return(Request $request,$idve)
    { 
    //    dd($request->all());
        $check=Ve::where('idve','=',$idve)->select('trangthai','tongtien')->first();
        if($check == null)
        {
         
                return redirect('xemve')->with('thanhcong', 'Vé đã bị xoá vui lòng đặt lại vé mới');
            
        }
        if($check->tongtien == $request->vnp_Amount/100) 
        {  
            if($check->trangthai==0)
            {          
                if($request->vnp_ResponseCode == "00") 
                {
                    Ve::where('idve','=',$idve)->update(['trangthai' => 1]);
                    $vedahoanthanh = DB::table('ve')->join('nguoidi','nguoidi.idve','=','ve.idve')->join('chuyenxe','chuyenxe.idchuyenxe','=','ve.idchuyenxe')
                    ->join('tuyenxe','tuyenxe.idtuyenxe','=','chuyenxe.idtuyenxe')->where('ve.idve','=',$idve)->where('trangthai',1)->first();
                    $allchongoi = [];
                    $thanhcong  = 'Vé đã được thanh toán, vui lòng lưu lại ảnh vé để phục vụ cho việc đối chiếu khi lên xe, xin cảm ơn !';
                    $chongoi = DB::table('ve')->join('nguoidi','nguoidi.idve','=','ve.idve')->join('chuyenxe','chuyenxe.idchuyenxe','=','ve.idchuyenxe')
                    ->join('tuyenxe','tuyenxe.idtuyenxe','=','chuyenxe.idtuyenxe')->where('ve.idve','=',$idve)->where('trangthai',1)->get();
                    foreach($chongoi as $cho)
                    {
                        $allchongoi[]=$cho->chongoi;
                    }
                    // dd($allchongoi);
                    // dd($vedahoanthanh);  
                    // return redirect('xemve',compact('vedahoanthanh'))->with('thanhcong', 'Bạn đã thanh toán vé');
                    return view('customerpage.xemve',compact('vedahoanthanh','allchongoi','thanhcong'))->with('thanhcong', 'Vé đã được thanh toán, vui lòng lưu lại ảnh vé để phục vụ cho việc đối chiếu khi lên xe, xin cảm ơn !');;
                }
                else
                {
                return redirect('xemve')->with('thanhcong', 'Qúa trình thanh toán vé bị lỗi');
                }

            }
            elseif($check->trangthai==1)
            {
                return redirect('xemve')->with('thanhcong', 'Vé đã được thanh toán');
            }
           
        }
        else
        {
            return redirect('xemve')->with('thanhcong', 'Số tiền thanh toán không hợp lệ vui lòng thanh toán lại');
        }
        
    }

    public function getLichSuDatVe()
    {  
        $ngay = (Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d'));
        $gio =(Carbon::now('Asia/Ho_Chi_Minh')->format('H:i:s'));
        $taikhoan1 = DB::table('users')->where('tentaikhoan', session('data')['tentaikhoan'])->first();
        $stt      = 0;
        if (session()->has('data')) {
            $taikhoan = DB::table('users')->select('idtk')->where('tentaikhoan', session('data')['tentaikhoan'])->first();
            $vedahuy = DB::table('ve')->select('ve.created_at','ve.idve','ve.soluong','ve.tongtien','ve.trangthai')
            ->join('chuyenxe','chuyenxe.idchuyenxe','=','ve.idchuyenxe') 
            ->where('ve.idtk',$taikhoan->idtk)->where('trangthai','=',2)->get(); 
       
            $vedadat = DB::table('ve')->select('ve.created_at','ve.idve','ve.soluong','ve.tongtien','ve.trangthai','chuyenxe.ngaydi','chuyenxe.giodi')->join('chuyenxe','chuyenxe.idchuyenxe','=','ve.idchuyenxe')
             ->where('ve.idtk',$taikhoan->idtk)->where('trangthai','=',1)->where('ngaydi','>',$ngay)->orWhere('ngaydi','=',$ngay)->where('giodi','>',$gio)->where('trangthai','=',1)->where('ve.idtk',$taikhoan->idtk)
             ->orWhere('trangthai','=',0)->where('ve.idtk',$taikhoan->idtk)
             ->orWhere('trangthai','=',1)->where('ve.idtk',$taikhoan->idtk)->where('ngaydi','<=',$ngay)->where('ngayden','>',$ngay)->where('giodi','<',$gio)
            ->get();
            foreach ($vedadat as $ve) {
                $stt         += 1;
                $ve->stt = $stt;
            }
        // dd($vedadat);
            $vedahoanthanh = DB::table('ve')->select('ve.created_at','ve.idve','ve.soluong','ve.tongtien','ve.trangthai')->join('chuyenxe','chuyenxe.idchuyenxe','=','ve.idchuyenxe')
            ->where('ve.idtk',$taikhoan->idtk)->where('trangthai','=',1)
            ->where('ngayden','<=',$ngay)->get(); 
            // dd($vedahoanthanh);
            foreach ($vedahoanthanh as $ve) {
                $stt         += 1;
                $ve->stt = $stt;
            }
            $count = count($vedahuy)  +  count($vedadat)  + count($vedahoanthanh); 
            if($count >0) // có đơn hàng thì mới cho xem
            {           
                return view('customerpage.lichsudatve',compact('count','vedahuy','vedadat','vedahoanthanh','taikhoan1'));
            }
             else
            {
                return redirect()->back()->with('thongbao', 'Bạn không có vé để xem');
            }
        }     
    }
}

