<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\UserLVTN;
class AdminAdmin extends Controller
{
    public function Authlogin()
    {
        $id=Session::get('id');
        $check=DB::table('users')->select('users.level')->where('users.idtk','=',$id)->first();
        if($id )
        {  if($check->level==3)
            {
                return redirect('dashboard');
            }
            return redirect('dashboard')->send();
        }else
        {
            return redirect('admin')->send();
        }
    }
    public function getDSAdmin(){
        $this->Authlogin();
        $users = DB::table('users')->where('users.level','=',2)->get();
        return view('adminpage.danhsachadmin',compact('users'));
    }
    public function Capnhatadmin($idtk)
    {
        
        $this->Authlogin();
        $laytrangthai = UserLVTN::where('idtk',$idtk)->first();
        //print($laytrangthai);exit; in ra từng biến chỉ viết -> để lấy thuộc tính
        if($laytrangthai->trangthai==1)
        {  
           $u = UserLVTN::where('idtk',$idtk)->update(['trangthai'=>-1]); // update là update của 1 mảng do chỉ update 1 thuộc tính nên cần []
         
           if($laytrangthai->level==2)
             {
             return redirect('danhsachadmin');
            }
        }
        if($laytrangthai->trangthai=-1)
        {  
           $u = UserLVTN::where('idtk',$idtk)->update(['trangthai'=>1]); // update là update của 1 mảng do chỉ update 1 thuộc tính nên cần []

            if($laytrangthai->level==2)
            {
             return redirect('danhsachadmin');
            }
        }
    }
    public function getThemAdmin()
    {
        $this->Authlogin();
        return view('adminpage.themadmin');
    }
    public function postThemAdmin(Request $req)
    {$this->Authlogin();
        $this->validate($req,
        [
            'email'=>'required|email',
            'tentaikhoan'=>'required',
            'password'=>'required|min:6|max:20',
            'hoten'=>'required',
            'cmnd'=>'required',
            'diachi'=>'required',
            'sdt'=>'required|numeric|digits:11',

        ],
        [
            'email.required'   => 'Bạn chưa nhập email',
            'email.email'=>'Bạn nhập chưa chính xác địa chi email(Ex: abc@gmail.com)',
            'tentaikhoan.required'=>'Bạn chưa nhập tên tài khoản',
            'password.required'=>'Vui lòng nhập mật khẩu',
            'password.min'=>'Mật khẩu cần ít nhất 6 ký tự',
            'password.max'=>'Mật khẩu không quá 20 ký tự',
            'hoten.required'=>'Bạn chưa nhập tên họ tên',
            'cmnd.required'=>'Bạn chưa nhập Căn cước công dân',
            'diachi.required'=>'Bạn chưa nhập địa chỉ',
            'sdt.required'=>'Bạn chưa nhập số điện thoại',
            'sdt.numeric'=>'Số điện thoại phải là chữ số',
            'sdt.digits'=>'Số điện thoại gồm 11 chữ số'


        ]);
        $data = new UserLVTN;
        $data->email=$req->email;
        $data->hoten=$req->hoten;
        $data->gioitinh=$req->gioitinh;
        $data->cmnd=$req->cmnd;
        $data->diachi=$req->diachi;
        $data->sdt=$req->sdt;
        $data->trangthai=1;
        $data->level=2;
        $data->tentaikhoan=$req->tentaikhoan;
        $data->password=md5($req->password);
        $users = DB::table('users')->get();
       
        foreach($users as $user)
        {
            if($data->email==$user->email)
            {   
                return redirect('themadmin')->with('thongbao', 'Email đã tồn tại');
            }
            else if($data->cmnd ==$user->cmnd )
            {
                return redirect('themadmin')->with('thongbao', 'Căn cước công dân đã tồn tại');
            }
            else if($data->tentaikhoan==$user->tentaikhoan)
            {
                return redirect('themadmin')->with('thongbao', 'Tên tài khoản đã tồn tại');
            }
            else if($data->sdt==$user->sdt)
            {
                return redirect('themadmin')->with('thongbao', 'Số điện thoại đã tồn tại');
            }
        }
        $data->save();
            return redirect('danhsachadmin')->with('thongbao', 'Thêm thành công');
    }
    public function getCapnhatlydo($idtk)
    {$this->Authlogin();
        $user = DB::table('users')->where('users.idtk','=',$idtk)->first();
        return view('adminpage.themlydo',compact('user'));
    }
    public function postCapnhatlydo($idtk,Request $req)
    {$this->Authlogin();
        $data['lydo']=$req->lydo;
        DB::table('users')->where('users.idtk','=',$idtk)->update($data);
        $laylevel = UserLVTN::where('idtk',$idtk)->first();
        if($laylevel->level==2)
       {return redirect('danhsachadmin')->with('thongbao', 'Cập nhập thành công');}
       else{
           return redirect('danhsachusers')->with('thongbao', 'Cập nhập thành công');
       }
    }
    public function getSuaadmin($idtk)
    {
        $this->Authlogin();
        $user = DB::table('users')->where('users.idtk','=',$idtk)->first();
        return view('adminpage.suaadmin',compact('user'));
    }
    public function postSuaadmin($idtk,Request $req)
    {
        $this->Authlogin();
        $this->validate($req,
        [
            'email'=>'required|email',
            'hoten'=>'required',
            'cmnd'=>'required|numeric|digits:12',
            'diachi'=>'required',
            'sdt'=>'required|numeric|digits:11',

        ],
        [
            'email.required'   => 'Bạn chưa nhập email',
            'email.email'=>'Bạn nhập chưa chính xác địa chi email(Ex: abc@gmail.com)',
            'hoten.required'=>'Bạn chưa nhập tên họ tên',
            'cmnd.required'=>'Bạn chưa nhập Căn cước công dân',
            'cmnd.numeric'=>'Số điện thoại phải là chữ số',
            'cmnd.digits'=>'Số điện thoại gồm 12 chữ số',
            'diachi.required'=>'Bạn chưa nhập địa chỉ',
            'sdt.required'=>'Bạn chưa nhập số điện thoại',
            'sdt.numeric'=>'Số điện thoại phải là chữ số',
            'sdt.digits'=>'Số điện thoại gồm 11 chữ số'


        ]);
        $check =DB::table('users')->where('users.idtk','=',$idtk)->first();
        $data['email']=$req->email;
        $data['hoten']=$req->hoten;
        $data['cmnd']=$req->cmnd;
        $data['diachi']=$req->diachi;
        $data['sdt']=$req->sdt;
        $users = DB::table('users')->get();
        foreach($users as $user)
        {
            if($check->email!=$data['email'])
            {
                if($data['email']==$user->email)
                {   
                 
                    return redirect('suaadmin/'.$idtk)->with('thongbao', 'Email đã tồn tại');
                }
            }
            if($check->cmnd!=$data['cmnd'])
            { if($data['cmnd'] ==$user->cmnd )
             {
                return redirect('suaadmin/'.$idtk)->with('thongbao', 'Căn cước công dân đã tồn tại');
             }
            }
            if($check->sdt!=$data['sdt'])
            {if($data['sdt']==$user->sdt)
            {
                return redirect('suaadmin/'.$idtk)->with('thongbao', 'Số điện thoại đã tồn tại');
            }}
        }
        DB::table('users')->where('users.idtk','=',$idtk)->update($data);
        return redirect('danhsachadmin')->with('thongbao', 'Cập nhập thành công');
    }
}
