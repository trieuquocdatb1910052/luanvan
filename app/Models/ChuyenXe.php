<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChuyenXe extends Model
{
    protected $table = "chuyenxe";
    protected $primaryKey = 'idchuyenxe';
    public function TuyenXe()
    {
    	return $this->belongTo('App\Models\TuyenXe','idtuyenxe','idchuyenxe');
    }
    public function Ve()
    {
    	return $this->hasMany('App\Models\Ve','idchuyenxe','idchuyenxe');
    }
    public function Xe()
    {
    	return $this->belongTo('App\Models\Xe','idxe','idchuyenxe');
    }
}
