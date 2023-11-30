<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    public function fillterByDate(Request $r){
        $data=$r->all();
        $from_date=$data['from_date'];
        $to_date=$data['to_date'];

        $donhang=DB::table('ve')->where('trangthai',1)->whereBetween('created_at',[$from_date,$to_date])->orderBy('created_at','ASC')->get();
        $ngay=DB::table('ve')->where('trangthai',1)->whereBetween('created_at',[$from_date,$to_date])->orderBy('created_at','ASC')->select('created_at')->distinct()->get();
        
        foreach($ngay as $value)
        {
            $tongtien=0;
             $i=0;
            foreach($donhang as $value1)
           { 
               if($value->created_at == $value1->created_at)
                {
                    $tongtien = $tongtien + $value1->tongtien;
                    $i++;                     
                }              
             }              
             $x[$value->created_at]=$tongtien;
             $a[]=array($value->created_at,$tongtien,$i);  
        }     
        foreach($a as $key=>$value)
        {    
            $char_data[]=array(
                'ngay'=>$value[0], 
                'tongtien'=>$value[1], 
                'soluong'=>$value[2]
           
            );      
        }
        echo $data=json_encode($char_data);
    }
}
