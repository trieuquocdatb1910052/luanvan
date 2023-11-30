<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\UserLVTN;

class AdminUsers extends Controller
{
    public function Authlogin()
    {
        $id=Session::get('id');
        $check=DB::table('users')->select('users.level')->where('users.idtk','=',$id)->first();
        if($id && $check->level>=2)
        {
            return redirect('dashboard');
        }else
        {
            return redirect('admin')->send();
        }
    }
    public function getDSUsers(){
        $this->Authlogin(); 
        $users = DB::table('users')->where('users.level','=',1)->get();
        $users1 = DB::table('users')->get();
        // $stt=0;
        // foreach($users1 as $u){
        //     $stt += 1;
        //     $u->stt=$stt;
        // }
        return view('adminpage.danhsachusers',compact('users','users1'));
    }
    public function Capnhatusers($idtk)
    {
        $this->Authlogin(); 

        $laytrangthai = UserLVTN::where('idtk',$idtk)->first();

        if($laytrangthai->trangthai==1)
        {  
           $u = UserLVTN::where('idtk',$idtk)->update(['trangthai'=>-1]);      
           return redirect('danhsachusers')->with('thongbao', 'Cập nhập thành công');
        }
        if($laytrangthai->trangthai==-1)
        {  
           $u = UserLVTN::where('idtk',$idtk)->update(['trangthai'=>1]); 
           return redirect('danhsachusers')->with('thongbao', 'Cập nhập thành công');
        }
    }
    public function getCapnhatlydouser($idtk)
    {
        $this->Authlogin();
        $user = DB::table('users')->where('users.idtk','=',$idtk)->first();
        return view('adminpage.themlydo',compact('user'));
    }
    public function postCapnhatlydouser($idtk,Request $req)
    {
        $this->Authlogin();
        $data['lydo']=$req->lydo;
        DB::table('users')->where('users.idtk','=',$idtk)->update($data);
        $laylevel = UserLVTN::where('idtk',$idtk)->first();
        if($laylevel->level==2)
       {
           return redirect('danhsachadmin')->with('thongbao', 'Cập nhập thành công');}
       else{
           return redirect('danhsachusers')->with('thongbao', 'Cập nhập thành công');
       }
    }
}
