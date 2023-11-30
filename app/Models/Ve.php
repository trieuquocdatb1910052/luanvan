<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ve extends Model
{
    protected $table = "ve";
    // protected $primaryKey = 'idve';
    public function ChuyenXe()
    {
    	return $this->belongTo('App\Models\Chuyenxe','idchuyenxe','id');
    }
    // public function GioVe()
    // {
    // 	return $this->belongTo('App\GioVe','idgiove','id');
    // }
   public function Xe()
   {
   		return $this->hasManyThrough('App\Models\Xe','App\Models\ChuyenXe','idve','idchuyenxe','id');
   }
   public function NguoiDi()
   {
    return $this->belongsTo('App\Models\NguoiDi','idve','id');
   }
}
