<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Ve;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\VeExport;


class AdminVe extends Controller
{
    public function Authlogin()
    {
        $id = Session::get('id');
        $check = DB::table('users')->select('users.level')->where('users.idtk', '=', $id)->first();
        if ($id && $check->level >= 2) {
            return redirect('dashboard');
        } else {
            return redirect('admin')->send();
        }
    }
    public function getDSVe()
    {
        $PhieuVe = DB::table('chuyenxe')->select(
            've.created_at',
            've.idve',
            've.soluong',
            've.tongtien',
            've.trangthai',
            've.cmnd',
            've.hoten',
            've.gioitinh',
            've.sdt',
            'tuyenxe.diemdi',
            'tuyenxe.diemden'
        )
            ->join('ve', 'chuyenxe.idchuyenxe', '=', 've.idchuyenxe')
            ->join('tuyenxe', 'chuyenxe.idtuyenxe', '=', 'tuyenxe.idtuyenxe')
            ->get();
        return view('adminpage.danhsachve', compact('PhieuVe'));
    }
    public function getCapnhatve($idve)
    {
        $this->Authlogin();
        $ve = DB::table('ve')->where('ve.idve', '=', $idve)->first();
        return view('adminpage.capnhatve', compact('ve'));
    }
    public function postCapnhatve(Request $req, $idve)
    {
        $this->Authlogin();
        $id = DB::table('ve')->where('ve.idve', '=', $idve)->first();
        if ($req->trangthai == 2) {
            if ($id->trangthai == 1) {
                return redirect('danhsachve')->with('thongbao', 'Vé đã thanh toán, không được hủy.');
            } else {
                $data['trangthai'] = $req->trangthai;
                DB::table('ve')->where('ve.idve', '=', $idve)->update($data);
                return redirect('danhsachve');
            }
        }
        $data['trangthai'] = $req->trangthai;

        DB::table('ve')->where('ve.idve', '=', $idve)->update($data);

        return redirect('danhsachve');
    }
    public function getChitietve($idve)
    {
        $this->Authlogin();
        $ve = DB::table('ve')->join('nguoidi', 'nguoidi.idve', '=', 've.idve')->join('chuyenxe', 'chuyenxe.idchuyenxe', '=', 've.idchuyenxe')
            ->join('tuyenxe', 'tuyenxe.idtuyenxe', '=', 'chuyenxe.idtuyenxe')->where('ve.idve', '=', $idve)->get();
        //  dd($ve);
        return view('adminpage.xemchitietve', compact('ve'));
    }
    public function getSuanguoidi($cmndnguoidi)
    {
        $this->Authlogin();
        $nguoidi = DB::table('nguoidi')->where('nguoidi.cmndnguoidi', '=', $cmndnguoidi)->first();
        return view('adminpage.suanguoidi', compact('nguoidi'));
    }
    public function postSuanguoidi($cmndnguoidi, Request $req)
    {
        $this->Authlogin();
        $idve = DB::table('nguoidi')->select('idve')->where('nguoidi.cmndnguoidi', '=', $cmndnguoidi)->first();
        $this->validate(
            $req,
            [
                'hotennguoidi' => 'required',
                'sdtnguoidi' => 'required',
            ],
            [
                'hotennguoidi.required'   => 'Bạn chưa nhập họ tên',
                'sdtnguoidi.required' => 'Bạn chưa nhập số điện thoại',
            ]
        );
        $data['hotennguoidi'] = $req->hotennguoidi;
        $data['sdtnguoidi'] = $req->sdtnguoidi;
        $users = DB::table('nguoidi')->get();
        $check = DB::table('nguoidi')->where('nguoidi.cmndnguoidi', '=', $cmndnguoidi)->first();
        foreach ($users as $user) {
            if ($check->sdtnguoidi != $data['sdtnguoidi']) {
                if ($data['sdtnguoidi'] == $user->sdtnguoidi) {

                    return redirect('suanguoidi/' . $cmndnguoidi)->with('thongbao', 'số điện thoại đã tồn tại');
                }
            }
        }
        DB::table('nguoidi')->where('nguoidi.cmndnguoidi', '=', $cmndnguoidi)->update($data);
        return redirect('chitietve/' . $idve->idve)->with('thongbao', 'Cập nhập thành công');
    }
    public function getHuyve($idve)
    {
        $this->Authlogin();
        $ve = DB::table('ve')->where('ve.idve', '=', $idve)->delete();
        //  dd($ve);
        return redirect('danhsachve');
    }

    //Xuat file excel
    public function getExportExcel()
    {
        return Excel::download(new VeExport, 've.xlsx');
    }
}
