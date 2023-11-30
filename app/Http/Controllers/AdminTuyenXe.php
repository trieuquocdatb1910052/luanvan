<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\TuyenXe;



class AdminTuyenXe extends Controller
{
    public function checkAuthLogin(){
        $username_admin = Session::get('hoten');
        if($username_admin == true){ //kiểm tra đã đăng nhập chưa
           return Redirect::to('dashboard'); //vào trang chính của quản lý Admin
        }else{
          return Redirect::to('admin')->send(); //trở về trang đăng nhập
         }
    }
    public function getTuyenxe()
    {
        $this->checkAuthLogin();
        $tuyenxe = DB::table('tuyenxe')->get();
        return view('adminpage.danhsachtuyenxe', compact('tuyenxe'));
    }
    public function getThemTuyenXe()
    {
        $this->checkAuthLogin();
        $tuyenxe = DB::table('tuyenxe')->get();
        $tinhthanh = DB::table('tinhthanh')->select('tinhthanh.ten_tinh')->get();
        return view('adminpage.themtuyenxe', $tuyenxe,compact('tinhthanh'));
    }
    public function postThemTuyenXe(Request $req)
    {
        // dd($_POST);
        $this->checkAuthLogin();
        $this->validate($req,
            [
                'diemdi'  => 'required',
                'diemden' => 'required',
                'dongia'  => 'required|numeric',
                'hinhanh' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',

            ],
            [
                'diemdi.required'  => ' Bạn hãy nhập điểm đi',
                'diemden.required' => ' Bạn hãy nhập điểm đến',
                'dongia.required'  => ' Bạn hãy nhập đơn giá',
                'dongia.numeric'   => ' Đơn giá chỉ được số',
                'hinhanh.required' => 'Bạn chưa chọn hình ảnh',
                'hinhanh.mimes'    => 'Vui lòng chọn đúng định dạng hình ảnh:JPEG - JPG - PNG - GIF - SVG',

            ]);
        $tuyen = DB::table('tuyenxe')->get();
        foreach ($tuyen as $t) {
            $diemdi   = $req->diemdi;
            $diemden  = $req->diemden;
            $rangbuoc = DB::table('tuyenxe')->where('idtuyenxe', $t->idtuyenxe)->first();
            if ($diemdi == $rangbuoc->diemdi && $diemden == $rangbuoc->diemden) {
                return redirect('themtuyenxe')->with('thongbao', 'Tuyến xe này đã tồn tại, vui lòng thêm lại !');
            }
        }
        $tuyenxe         = new TuyenXe();
        $tuyenxe->diemdi = $req->diemdi;
        $tuyenxe->diemden = $req->diemden;
        if ($req->diemdi == $req->diemden) {
            return redirect('themtuyenxe')->with('thongbao', 'Điểm đi và điểm đến trùng nhau, xin nhập lại !');
        } else {
            $tuyenxe->diemdi  = $req->diemdi;
            $tuyenxe->diemden = $req->diemden;
            if ($req->hasFile('hinhanh')) // có tồn tại hình ảnh
            {           
                $uploadPath = public_path('/images/anhtuyenxe');    
                $req->file('hinhanh')->move($uploadPath, $req->file('hinhanh')->getClientOriginalName()); //
            } else {
                return redirect()->back()->with('error', 'Upload files thất bại!');
            }
            $tuyenxe->hinhanh = $req->file('hinhanh')->getClientOriginalName();
            $tuyenxe->dongia  = $req->dongia;
            $tuyenxe->save();
            return redirect('danhsachtuyenxe')->with('thongbao', 'Thêm thành công');
        }
    }
    public function getSuaTuyenXe($id)
    {
        $this->checkAuthLogin();
        $tuyenxe = DB::table('tuyenxe')->where('idtuyenxe', $id)->first();
        return view('adminpage.suatuyenxe', compact('tuyenxe'));
    }
    public function postSuaTuyenXe(Request $req, $id)
    {
        $this->checkAuthLogin();
        $this->validate($req,
            [
                'diemdi'  => 'required',
                'diemden' => 'required',
                'hinhanh' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
                'dongia'  => 'required|numeric',

            ],
            [
                'diemdi.required'  => ' Bạn hãy nhập điểm đi',
                'diemden.required' => ' Bạn hãy nhập điểm đến',
                'hinhanh.required' => 'Bạn chưa chọn hình ảnh',
                'hinhanh.mimes'    => 'Vui lòng chọn đúng định dạng hình ảnh:JPEG - JPG - PNG - GIF - SVG',
                'dongia.required'  => ' Bạn hãy nhập đơn giá',
                'dongia.numeric'   => ' Đơn giá chỉ được số',

            ]);
        $tuyenxe          = TuyenXe::find($id);
        $tuyenxe->diemdi  = $req->diemdi;
        $tuyenxe->diemden = $req->diemden;
        if ($req->hasFile('hinhanh')) {
            $uploadPath = public_path('/images/anhtuyenxe'); 
            $req->file('hinhanh')->move($uploadPath, $req->file('hinhanh')->getClientOriginalName());      
            $tuyenxe->hinhanh = $req->file('hinhanh')->getClientOriginalName();
        } else {
            $tuyenxe->hinhanh = $req->hinhanh2; //luu hình ảnh củ
        }
        $tuyenxe->dongia = $req->dongia;
        $tuyenxe->save();
        return redirect('danhsachtuyenxe')->with('thongbao', 'Sửa thành công');
    }

    public function getXoaTuyenXe($id)
    {
        $this->checkAuthLogin();
        $chuyen = DB::table('chuyenxe')->select('idtuyenxe')->where('idtuyenxe', $id)->first();
        $tuyen  = DB::table('tuyenxe')->select('idtuyenxe')->where('idtuyenxe', $id)->first();
        if ($tuyen == $chuyen) {
            return redirect('danhsachtuyenxe')->with('thongbao', 'Xóa thất bại,vui lòng xóa chuyến xe trước khi xóa tuyến xe');
        } else {
            $tuyenxe = DB::table('tuyenxe')->where('idtuyenxe', $id)->delete();
            return redirect('danhsachtuyenxe')->with('thongbao', 'Xóa thành công');
        }
    }
}
