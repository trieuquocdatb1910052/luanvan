<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TuyenXe extends Model
{
    //
    protected $table = "tuyenxe";
    protected $primaryKey = 'idtuyenxe';
    public function ChuyenXe()
    {
    	return $this->hasMany('App\Models\ChuyenXe','idtuyenxe', 'idtuyenxe');
    }
    public function Xe()
    {
    	return $this->hasManyThrough('App\Models\Xe','App\Models\ChuyenXe','idtuyenxe','idchuyenxe','idtuyenxe');
    }
}
