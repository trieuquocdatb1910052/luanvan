<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Xe extends Model
{
    protected $table = "xe";
    protected $primaryKey = 'idxe';
    public function ChuyenXe()
    {
    	return $this->hasMany('App\Models\ChuyenXe','idxe','idxe'); //1 xe sẽ có nhiều chuyến xe
    }
}
