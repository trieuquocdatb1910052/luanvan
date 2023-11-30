<?php

use App\Http\Controllers\MXHController;
use App\Http\Controllers\AdminXe;
use Illuminate\Support\Facades\Route;


use function Ramsey\Uuid\v1;

Route::get('test','HomeController@test'); 

//Giao dien và code xử lý phia nguoi dung
Route::get('/','HomeController@getIndex')->name('index'); //Trang chủ
Route::get('gioithieu','HomeController@getGioiThieu');
Route::get('lienhe','HomeController@getLienHe'); 
Route::get('/dangky','HomeController@getDangKy'); //giao dien dang ky
Route::post('/dangky','HomeController@postDangKy'); //Xu ly du lieu dang ky
Route::get('dangnhap','HomeController@getDangNhap'); //Giao dien dang nhap
Route::post('/dangnhap','HomeController@postDangNhap'); //Xu ly du lieu dang nhap
Route::get('tuyenxe/{idtuyenxe}','HomeController@getChuyenxe'); //Tra ve cac chuyen xe co trong ngay
Route::get('thongtinkh/{id}','HomeController@getSuaThongTinKH');
Route::post('suathongtinkh/{id}','HomeController@postSuaThongTinKH');
Route::get('doimatkhau/{id}','HomeController@getDoiMatKhauKH');
Route::post('doimatkhau/{id}','HomeController@postDoiMatKhauKH');
Route::get('lichsudatve','HomeController@getLichSuDatVe');
Route::get('dangxuatKH','HomeController@getDangXuat'); //Dang xuat KH

Route::get('xemve','HomeController@getXemve');
Route::get('xemve1','HomeController@getXemVe1');
Route::get('chitietveuser/{idve}',[
    'as'=>'chitietveuser',
    'uses'=>'HomeController@getChitietveuser'
]);  
Route::get('timkiemchuyenxe',[
    'as'=>'timkiemchuyenxe',
    'uses'=>'HomeController@getTimkiemchuyenxe'
]);  
Route::get('datve/{id}',[
    'as'=>'datve',
    'uses'=>'HomeController@getDatve'
]);
Route::post('datve/{id}',[
    'as'=>'datve',
    'uses'=>'HomeController@postDatve'
]);
Route::get('huyve/{id}',[
    'as'=>'huyve',
    'uses'=>'HomeController@getHuyve'
]);
Route::get('thanhtoan/{id}',[
    'as'=>'thanhtoan',
    'uses'=>'HomeController@getThanhtoan'
]);
Route::post('thanhtoan/{id}',[
    'as'=>'thanhtoan',
    'uses'=>'HomeController@postThanhtoan'
]);



Route::get('/reset_pass','MailController@getResetPass');
Route::post('/reset_password','MailController@postResetPass');

//Giao diện và code xử lý Admin
Route::get('/admin','AdminController@index'); //Trang đăng nhập của Admin.
Route::get('/dashboard','AdminController@getLogin'); //Hiển thị trang chủ Admin
Route::post('/dashboard_admin','AdminController@postLogin'); //Xử lý đăng nhập để vào ->dashboard
Route::get('/logout','AdminController@getLogout'); //Đăng xuất


//Login G+ Socialite
Route::get('/google','MXHController@googleRedirect');
Route::get('/google/callback',[MXHController::class,"handleGoogleCallback"]);


//Login Facebook
Route::get('/facebook','MXHController@FacebookRedirect');
Route::get('/facebook/callback','MXHController@handleFacebookCallback');

Route::match(['GET','POST'],'/confirm_register/{code}','MailController@xacNhanEmail');

//Lay code dang ky tu sms
Route::get('/nhapcode','VerifyCodeController@getNhapCode');
Route::post('/verifycode','VerifyCodeController@postVerifyCode');
Route::get('/send/code','SMSController@sendMessage');

Route::post('payment','HomeController@createPayment')->name('payment.online');
Route::get('return/{idve}','HomeController@return')->name('payment.return');


//Quan ly thong ke
Route::post('/fillterByDate', 'AjaxController@fillterByDate');
Route::post('/dashboardFillter', 'AjaxController@dashboardFillter');



/**---------------------------------------------------------------------------------------------------- **/
//Quan ly xe 
Route::get('/danhsachxe','AdminXe@getDSXe'); //Hiển thị danh sách các xe
Route::get('/themxe','AdminXe@getThemXe'); //Giao diện thêm xe
Route::post('/themxe','AdminXe@postThemXe'); // Xử lý thêm xe
Route::get('/suaxe/{idxe}','AdminXe@getSuaXe'); //Giao diện thêm xe
Route::post('/suaxe/{idxe}','AdminXe@postSuaXe'); //Xử lý sửa thông tin xe
Route::get('/xoaxe/{idxe}','AdminXe@getXoaXe');// Xóa xe
Route::get('/xoaxe/{idxe}','AdminXe@getXoaXe');// Xóa xe
Route::get('/changeStatus','AdminXe@thayDoiTrangThaiXe');


//Quan ly tuyen xe
Route::get('danhsachtuyenxe','AdminTuyenXe@getTuyenxe');
Route::get('themtuyenxe','AdminTuyenXe@getThemTuyenXe');
Route::post('themtuyenxe','AdminTuyenXe@postThemTuyenXe');
Route::get('suatuyenxe/{idtuyenxe}','AdminTuyenXe@getSuaTuyenXe');
Route::post('suatuyenxe/{idtuyenxe}','AdminTuyenXe@postSuaTuyenXe');
Route::get('xoatuyenxe/{idtuyenxe}','AdminTuyenXe@getXoaTuyenXe');


//Quan ly tuyen xe
Route::get('danhsachchuyenxe','AdminChuyenXe@getChuyenxe');
Route::get('themchuyenxe','AdminChuyenXe@getThemChuyenXe');
Route::post('themchuyenxe','AdminChuyenXe@postThemChuyenXe');
Route::get('xoachuyenxe/{id}','AdminChuyenXe@getXoaChuyenXe');
Route::get('suachuyenxe/{idchuyenxe}','AdminChuyenXe@getSuaChuyenXe');
Route::post('suachuyenxe/{idchuyenxe}','AdminChuyenXe@postSuaChuyenXe');

//Quan ly admin
Route::get('danhsachadmin','AdminAdmin@getDSAdmin');
Route::get('capnhatadmin/{idtk}',[
    'as'=>'capnhatadmin',
    'uses'=>'AdminAdmin@Capnhatadmin'
]);   
Route::get('themadmin','AdminAdmin@getThemAdmin');
Route::post('themadmin','AdminAdmin@postThemAdmin');
Route::get('capnhatlydo/{idtk}',[
    'as'=>'capnhatlydo',
    'uses'=>'AdminAdmin@getCapnhatlydo']);
Route::post('capnhatlydo/{idtk}',[
    'as'=>'capnhatlydo',
    'uses'=>'AdminAdmin@postCapnhatlydo']);
Route::get('suaadmin/{idtk}',[
    'as'=>'suaadmin',
    'uses'=>'AdminAdmin@getSuaadmin'
]);
Route::post('suaadmin/{idtk}',[
    'as'=>'suaadmin',
    'uses'=>'AdminAdmin@postSuaadmin'
]);

//Quan ly users
Route::get('danhsachusers','AdminUsers@getDSUsers');
Route::get('capnhat-users/{idtk}',[
    'as'=>'capnhatusers',
    'uses'=>'AdminUsers@Capnhatusers'
]);   
Route::get('capnhatlydouser/{idtk}',[
    'as'=>'capnhatlydouser',
    'uses'=>'AdminUsers@getCapnhatlydouser']);
Route::post('capnhatlydouser/{idtk}',[
    'as'=>'capnhatlydouser',
    'uses'=>'AdminUsers@postCapnhatlydouser']);
    Route::get('capnhatusers/{idtk}',[
        'as'=>'capnhatusers',
        'uses'=>'AdminUsers@Capnhatusers'
    ]);   


//Quan ly ve
Route::get('danhsachve','AdminVe@getDSVe');
Route::get('capnhatve/{idve}',[
    'as'=>'capnhatve',
    'uses'=>'AdminVe@getCapnhatve'
]);   
Route::post('capnhatve/{idve}',[
    'as'=>'capnhatve',
    'uses'=>'AdminVe@postCapnhatve'
]);   
Route::get('chitietve/{idve}',[
    'as'=>'chitietve',
    'uses'=>'AdminVe@getChitietve'
]);   
Route::get('suave/{idve}',[
    'as'=>'suave',
    'uses'=>'AdminVe@getSuave'
]);   
Route::get('suanguoidi/{cmndnguoidi}',[
    'as'=>'suanguoidi',
    'uses'=>'AdminVe@getSuanguoidi'
]);   
Route::post('suanguoidi/{cmndnguoidi}',[
    'as'=>'suanguoidi',
    'uses'=>'AdminVe@postSuanguoidi'
]);   

Route::get('huyveadmin/{id}',[
    'as'=>'huyveadmin',
    'uses'=>'AdminVe@getHuyve'
]);

Route::get('xuatExcelVe','AdminVe@getExportExcel');