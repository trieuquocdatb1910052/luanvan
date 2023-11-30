<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\ChuyenXe;


class AdminChuyenXe extends Controller
{

    public function checkAuthLogin(){
        $username_admin = Session::get('hoten');
        if($username_admin == true){ //kiểm tra đã đăng nhập chưa
           return Redirect::to('dashboard'); //vào trang chính của quản lý Admin
        }else{
          return Redirect::to('admin')->send(); //trở về trang đăng nhập
         }
    }
    public function getChuyenxe()
    {
        $this->checkAuthLogin();
        $chuyenxe = DB::table('chuyenxe')->join('tuyenxe','chuyenxe.idtuyenxe','=','tuyenxe.idtuyenxe')->join('xe','xe.idxe','=','chuyenxe.idxe')->get();
        $stt      = 0;
        foreach ($chuyenxe as $chuyen) {
            $stt         += 1;
            $chuyen->stt = $stt;
        }
        return view('adminpage.danhsachchuyenxe', compact('chuyenxe'));
    }
    public function getThemChuyenXe()
    {
        $this->checkAuthLogin();
        $chuyenxe = DB::table('chuyenxe')->get();
        $tuyenxe  = DB::table('tuyenxe')->get();
        foreach ($chuyenxe as $chuyen) {
            $data[] = $chuyen->idxe;
        }
        // $xe1 = DB::table('xe')->get();
        $xe = DB::table('xe')
            ->whereNotIn('idxe', $data) //kiem tra gia tri cua cot nam ngoai mang
            ->get();
        return view('adminpage.themchuyenxe', compact('chuyenxe', 'tuyenxe', 'xe'));
    }
    public function postThemChuyenXe(Request $req)
    {        
        // dd($_POST);
        $this->checkAuthLogin();
        $this->validate($req,
            [
                'giodi'   => 'required|regex:/[0-9]/',
                'gioden'  => 'required|regex:/[0-9]/',
                'ngaydi'  => 'required',
                'ngayden' => 'required',
                'idxe'   => 'required',
                'noixuatben' => 'required|regex:/[a-zA-Z\s]/',
            ],
            [
                'giodi.required'   => 'Bạn chưa nhập giờ đi',
                'giodi.regex'      => 'Giờ đi không được nhập chữ',
                'gioden.required'  => 'Bạn chưa nhập giờ đến',
                'gioden.regex'     => 'Giờ đến không được nhập chữ',
                'ngaydi.required'  => 'Bạn chưa chọn ngày đi',
                'ngayden.required' => 'Bạn chưa chọn ngày đến',
                'idxe.required'    => 'Vui lòng chọn xe',
                'noixuatben.required' => 'Vui lòng nhập địa điểm xuất bến',
                'noixuatben.regex' => 'Điểm xuất bến bao gồm chữ và số',
            ]);
        $chuyen = DB::table('chuyenxe')->get();
        $ngaydi = date('Y-m-d', strtotime($req->ngaydi));
        $ngayhientai    = now()->toDateString('Y-m-d');
        foreach ($chuyen as $c) {  
            if ($ngaydi == $c->ngaydi) {
                if ($req->giodi == $c->giodi || $req->gioden == $c->gioden) {
                    return redirect()->back()->with('thongbao', 'Thêm thất bại, giờ đi hoặc giờ đến không thể trùng trong một ngày của chuyến');
                }
            }
        }
        $chuyenxe = new ChuyenXe();
        if ($req->giodi == $req->gioden) {
            return redirect('themchuyenxe')->with('thongbao', 'Bạn không được nhập giờ đi và giờ đến trùng nhau');
        }
        else if($req->ngayden < $ngayhientai || $req->ngaydi < $ngayhientai){
            return redirect('themchuyenxe')->with('thongbao', 'Ngày đi hoặc ngày đến không thể nhỏ hơn ngày hiện tại');
        }
        else if($req->ngayden < $req->ngaydi)
        {
            return redirect('themchuyenxe')->with('thongbao', 'Ngày đến không thể nhỏ hơn ngày đi');
        }
         else {
            $chuyenxe->giodi     = $req->giodi;
            $chuyenxe->gioden    = $req->gioden;
            $chuyenxe->ngaydi    = $req->ngaydi;
            $chuyenxe->ngayden   = $req->ngayden;
            $chuyenxe->noixuatben = $req->noixuatben;
            $chuyenxe->idtuyenxe = $req->idtuyenxe;
            $chuyenxe->idxe      = $req->idxe;
            $chuyenxe->save();
            return redirect('danhsachchuyenxe')->with('thongbao', 'Thêm thành công');
        }
    }

    public function getSuaChuyenXe($id)
    {
        $this->checkAuthLogin();
        $chuyenxe = DB::table('chuyenxe')
            ->join('tuyenxe', 'chuyenxe.idtuyenxe', '=', 'tuyenxe.idtuyenxe')
            ->join('xe', 'chuyenxe.idxe', '=', 'xe.idxe')
            ->where('idchuyenxe', $id)->first();
        $layxe   = DB::table('chuyenxe')->get();
        $tuyenxe = DB::table('tuyenxe')->get();
        foreach ($layxe as $chuyen) {
            $data[] = $chuyen->idxe;
        }
        $xe = DB::table('xe')
            ->whereNotIn('idxe', $data)
            ->get();
        return view('adminpage.suachuyenxe', compact('chuyenxe', 'tuyenxe', 'xe'));
    }

    public function postSuaChuyenXe(Request $req, $id)
    {
        $this->checkAuthLogin();
        $chuyen = DB::table('chuyenxe')->get();
        $ngaydi = date('Y-m-d', strtotime($req->ngaydi));
        $this->validate($req,
            [
                'giodi'   => 'required|regex:/[0-9]/',
                'gioden'  => 'required|regex:/[0-9]/',
                'ngaydi'  => 'required',
                'ngayden' => 'required',
                'noixuatben' => 'required|regex:/[a-zA-Z\s]/',
            ],
            [
                'giodi.required'   => 'Bạn chưa nhập giờ đi',
                'giodi.regex'      => 'Giờ đi không được nhập chữ',
                'gioden.required'  => 'Bạn chưa nhập giờ đến',
                'gioden.regex'     => 'Giờ đến không được nhập chữ',
                'ngaydi.required'  => 'Bạn chưa chọn ngày đi',
                'ngayden.required' => 'Bạn chưa chọn ngày đến',
                'noixuatben.required' => 'Bạn chưa nhập nơi xuất bến',
                'noixuatben.regex' => 'Địa chỉ xuất bến bao gồm chữ và số',
            ]);
        $chuyenxe            = ChuyenXe::find($id);
        $chuyenxe->giodi     = $req->giodi;
        $chuyenxe->gioden    = $req->gioden;
        $chuyenxe->ngaydi    = $req->ngaydi;
        $chuyenxe->ngayden   = $req->ngayden;
        $chuyenxe->noixuatben = $req->noixuatben;
        $chuyenxe->idtuyenxe = $req->idtuyenxe;
        $chuyenxe->idxe      = $req->idxe;
        $chuyenxe->save();
        return redirect('danhsachchuyenxe')->with('thongbao', 'Sửa thành công');
    }

    public function getXoaChuyenXe($id)
    {
        $this->checkAuthLogin();
        $chuyen = DB::table('chuyenxe')->select('idchuyenxe')->where('idchuyenxe', $id)->first();
        $ve     = DB::table('ve')->select('idchuyenxe')->where('idchuyenxe', $id)->first();
        if ($chuyen == $ve) {
            return redirect('danhsachchuyenxe')->with('thongbao', 'Xóa thất bại,chuyến xe này đã có vé được đặt');
        } else {
            $chuyen = DB::table('chuyenxe')->where('idchuyenxe', $id)->delete();
            return redirect('danhsachchuyenxe')->with('thongbao', 'Xóa thành công');
        }
    }
}
