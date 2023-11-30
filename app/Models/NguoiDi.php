<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NguoiDi extends Model
{
    protected $table = 'nguoidi';
    public function Ve()
    {
    	return $this->hasMany('App\Models\Ve','idve','id');
    }
}


