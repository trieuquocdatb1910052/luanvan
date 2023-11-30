<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\Ve;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Xe;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $mang =Ve::get();
        $test = (Carbon::now('Asia/Ho_Chi_Minh')->addHour(-2)->format('Y-m-d H:i:s'));
        foreach ($mang as $value)
        {     
            if($value->created_at <= $test && $value->trangthai ==0)
            {
                
            Ve::where('created_at','=', $value->created_at)->delete();
            }

        }
        // $mangxe =DB::table('xe')->join('chuyenxe','chuyenxe.idxe','=','xe.idxe')->get();
        // // dd($mang);
        // $ngay = (Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d'));
        // $gio = (Carbon::now('Asia/Ho_Chi_Minh')->format('H:i:s'));
        
        // foreach ($mangxe as $value)
        // {    
        //   if($value->ngayden==$ngay && $value->gioden<$gio || $value->ngayden<$ngay )
        //   {
            
        //       $mangchuaidxe[]=$value->idxe;
            
        //   }

        // }
        // //  dd($mangchuaidxe);
      
        // $laythongtinxecu=DB::table('xe')->whereIn('idxe',$mangchuaidxe)->get();

        // //  dd($laythongtinxecu);
       
        //     foreach($laythongtinxecu as $value)
        //     {
        //         if($value->trangthai==1)
        //         {
        //             $xemoi                  = new Xe;  
        //             $xemoi->bienso     = $value->bienso;
        //             $xemoi->soghe=$value->soghe;
        //             $xemoi->loaixe    = $value->loaixe;
        //             $xemoi->hinhxe    = $value->hinhxe;
        //             $xemoi->trangthai   = 1;
        //             $xemoi->save();
        //         }
        //     } 
        
        // DB::table('xe')->whereIn('idxe',$mangchuaidxe)->update(['trangthai' => 0]);
        Schema::defaultStringLength(191);
    }
}
