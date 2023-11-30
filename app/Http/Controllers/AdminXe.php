<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Xe;
use App\Exports\XeExport;
use Maatwebsite\Excel\Facades\Excel;




class AdminXe extends Controller
{

    ///Kiem tra da dang nhap chua
    public function checkAuthLogin()
    {
        $username_admin = Session::get('hoten');
        if ($username_admin == true) { //kiểm tra đã đăng nhập chưa
            return Redirect::to('dashboard'); //vào trang chính của quản lý Admin
        } else {
            return Redirect::to('admin')->send(); //trở về trang đăng nhập
        }
    }
    public function getDSXe()
    {
        $this->checkAuthLogin();
        $xe = DB::table('xe')->get();
        return view('adminpage.danhsachxe', compact('xe')); //Giao dien ds xe
    }

    public function getThemXe()
    {
        $this->checkAuthLogin();
        return view('adminpage.themxe'); //giao diện thêm xe
    }

    public function postThemXe(Request $req)
    {
        $this->checkAuthLogin();
        $this->validate(
            $req,
            [
                'bienso' => 'required|max:12',
                'soghe'  => 'required|numeric|max:42',
                'hinhxe' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'bienso.required' => ' Bạn hãy nhập biển số',
                'soghe.required'  => ' Bạn hãy nhập số ghế',
                'bienso.max'      => ' Biển số vượt mức quy định',
                'soghe.numeric'   => 'Số  ghế chỉ được số',
                'soghe.max'       => ' Số ghế vượt mức cho phép >= 40',
                'hinhxe.required' => 'Bạn chưa chọn hình xe',
                'hinhxe.mimes'    => 'Vui lòng chọn đúng định dạng hình ảnh:JPEG - JPG - PNG - GIF - SVG',
            ]
        );

        $data = array();
        $data['bienso'] = $req->bienso;
        $data['soghe'] = $req->soghe;
        $data['loaixe'] = $req->loaixe;
        if ($req->hasFile('hinhxe')) {
            $uploadPath = public_path('/images/anhxe');
            $req->file('hinhxe')->move($uploadPath, $req->file('hinhxe')->getClientOriginalName());
        } else {
            return redirect()->back()->with('error', 'Upload files thất bại!');
        }
        $data['hinhxe'] = $req->file('hinhxe')->getClientOriginalName();
        DB::table('xe')->insert($data);
        return redirect('danhsachxe')->with('thongbao', 'Thêm xe vào danh sách thành công');
    }
    public function getSuaXe($id)
    {
        $xe = DB::table('xe')->where('idxe', $id)->first();
        return view('adminpage.suaxe', compact('xe')); //giao diện sửa thông tin xe
    }
    public function postSuaXe(Request $req, $id)
    {
        // dd($_POST);
        $this->checkAuthLogin();
        $this->validate($req,
            [
                'bienso' => 'required|max:12',
                'soghe'  => 'required|numeric|max:52',
                'hinhxe' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'bienso.required' => ' Bạn chưa nhập biển số',
                'soghe.required'  => ' Bạn chưa nhập số ghế',
                'bienso.max'      => ' Biển số vượt mức quy định',
                'soghe.numeric'   => 'Số ghế chỉ được số',
                'soghe.max'       => ' Số ghế vượt mức',
                'hinhxe.mimes'    => 'Vui lòng chọn đúng định dạng hình ảnh:JPEG - JPG - PNG - GIF - SVG',
            ]);
            $data = array();
            $data['bienso'] = $req -> bienso;
            $data['soghe'] = $req -> soghe;
            $data['loaixe'] = $req -> loaixe;
            if ($req->hasFile('hinhxe'))
            {
                // die('22');
                $uploadPath = public_path('/images/anhxe');
                $req->file('hinhxe')->move($uploadPath, $req->file('hinhxe')->getClientOriginalName());
                $data['hinhxe'] = $req->file('hinhxe')->getClientOriginalName();
            }
            else 
            {
                $data['hinhxe'] = $req->hinhxecu;
            }
            DB::table('xe')->where('idxe',$id)->update($data);
            return redirect('suaxe/'.$id)->with('thongbao', 'Cập nhập thành công');

    }

    public function getXoaXe($id)
    {
        $this->checkAuthLogin();
        $chuyen = DB::table('chuyenxe')->select('idxe')->where('idxe', $id)->first();
        $x      = DB::table('xe')->select('idxe')->where('idxe', $id)->first();
        if ($chuyen == $x) {
            return redirect('danhsachxe')->with('thongbao', 'Xóa thất bại, xe đã có chuyến !');
        } else {
            $xe = DB::table('xe')->where('idxe', $id)->delete();
            return redirect('danhsachxe')->with('thongbao', 'Xóa thành công');
        }
    }

    /**Thay đổi trạng thái xe */
    public function thayDoiTrangThaiXe(Request $req)
    {
        $xe = Xe::find($req->idxe);
        $xe->trangthai = $req->trangthai;
        $xe->save();
        return response()->json(['success' => 'Thay đổi trạng thái thành công']);
    }

    //Xuat file excel
    public function getExportExcel()
    {
        $this->checkAuthLogin();
        return Excel::download(new XeExport, 'xe.xlsx');
    }
    public function text()
    {
        $this->checkAuthLogin();
        Excel::create();
        return view('adminpage.test');
    }
}
