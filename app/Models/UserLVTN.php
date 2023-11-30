<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\CanResetPassword;

class UserLVTN extends Model
{
    protected $table = "users";
    protected $primaryKey = 'idtk';
    protected $fillable =[
        'hoten','email','password','google_id','facebook_id'
    ];
    public function Ve()
    {
    	return $this->hasManyThrough('App\Models\Ve','App\Models\GioVe','idtk','idgiove','id');
    }
}
