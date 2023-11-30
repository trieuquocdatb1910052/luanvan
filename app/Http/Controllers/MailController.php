<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Models\UserLVTN;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;

class MailController extends Controller
{
    public function getResetPass(){
        return view('customerpage.form_laymatkhau');
    }

    public function postResetPass(Request $req)
    { 
      if($req->isMethod('post')){
        $data = $req->all();
        $userCount = UserLVTN::where('email',$data['email'])->count();
        if($userCount == 0){
            return redirect()->back()->with('thongbao','Email không tồn tại');
        }
        //Lay thong tin chi tiet KH
       $cusDetail = UserLVTN::where('email',$data['email'])->first();
        //Random Password
       $random_pass = Str::random(8);
       //Encode - Bao mat pass
       $new_pass = bcrypt($random_pass);       
       //Update password
       UserLVTN::where('email',$data['email'])->update(['password'=>$new_pass]);
       //Send Forgot password email code
       $email = $data['email'];
       $hoten = $cusDetail->hoten;
       $taikhoan = $cusDetail->tentaikhoan;
       $msgData = [
           'email' => $email,
           'hoten' => $hoten,
        'password' => $random_pass,
        'taikhoan' => $taikhoan
        ];
        Mail::send('customerpage.forgot_pass',$msgData,function($message)use($email){
            $message->to($email)->subject('Mật khẩu mới - LIFE Website');
        });
      } 
      return redirect()->back()->with('thanhcong','Mật khẩu được gửi về gmail đăng ký, khách hàng vui lòng kiểm tra lại');
    }

    /*Xác nhận đăng ký tài khoản*/
    public function xacNhanEmail($email)
    {
        $email = base64_decode($email); // chuyen doi du lieu luu tru thanh du lieu su dung
        $userCount = UserLVTN::where('email',$email)->count();
        if($userCount>0){
            $cusDetail = UserLVTN::where('email',$email)->first();
            if($cusDetail->trangthai==0){ 
                UserLVTN::where('email',$email)->update(['trangthai'=>1]);
                $msgData=[
                    'hoten'=>$cusDetail['hoten'],
                    'sdt'=>$cusDetail['sdt'],
                    'email'=>$cusDetail['email']
                 ];
                //  Mail::send('customerpage.success_register',$msgData,function($message)use($email){
            //      $message->to($email)->subject('Chào mừng bạn đến với STU-Bus Website !');
                //  });
                 return redirect('dangnhap')->with('new_actived','Tài khoản được kích hoạt, vui lòng đăng nhập');
            }
            else{
                return redirect('dangnhap')->with('actived','Xác nhận thất bại');
            }
        }else{
            abort(404);
        }
    }
}
