<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MangXaHoi extends Model
{
    protected $filltable=['user_id','provider_user_id','provider'];

    public function user(){
        return $this->belongsTo(UserLVTN::class);
    }
}
