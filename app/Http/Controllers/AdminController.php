<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class AdminController extends Controller
{
    public function checkAuthLogin(){
        $username_admin = Session::get('hoten');
        if($username_admin == true){ 
           return Redirect::to('dashboard'); 
        }else{
          return Redirect::to('admin')->send(); 
         }
    }
    public function index(){
        return view('adminpage.login_admin');
    }

    public function getLogin(){
        $this->checkAuthLogin();
        $xe_active = DB::table('xe')->where('trangthai',1)->get();
        $xe_unactive=DB::table('xe')->where('trangthai',0)->get();
        $nguoidi = DB::table('nguoidi')->get();
        $khachhang = DB::table('users')->where('level',1)->get();
        $ve_huy = DB::table('ve')->where('trangthai',2)->get();
        $doanhthu = DB::table('ve')->select('ve.tongtien')->get();
        $tongtien=0;
        foreach($doanhthu as $dt){
            $tongtien = $dt->tongtien + $tongtien;
        }
        return view('adminpage.home_admin',compact('xe_active','xe_unactive','nguoidi','khachhang','ve_huy','doanhthu','tongtien'));
    }

    /**Xử lý dữ liệu đăng nhập Admin */
    public function postLogin(Request $req)
    {
        $username = $req->tentaikhoan; //truong ben form
        $password = md5($req->password);
        $result = DB::table('users')->where('tentaikhoan',$username)->where('password',$password)->first();
        $taikhoanbicam = DB::table('users')->where('tentaikhoan', $req->tentaikhoan)->first();
        if(isset($result) && $taikhoanbicam->trangthai==1){
            Session::put('hoten',$result->hoten);
            Session::put('id',$result->idtk);
           return Redirect::to('/dashboard');
        }
        else if(isset($result) && $taikhoanbicam->trangthai==-1)
        {
            return redirect()->back()->with(['thongbaokhoa' => 'Đăng nhập không thành công, tài khoản này đã bị cấm, vì lý do: ' . $taikhoanbicam->lydo]);
        }
        else{
            return redirect('/admin')->with('thongbao', 'Tài khoản hoặc mật khẩu không chính xác');
        }
    } 

    //Dang xuat
    public function getLogout()
    {
        session()->forget('data');
        return view('adminpage.login_admin');
    }
}
