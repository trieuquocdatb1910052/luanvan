<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class MXHController extends Controller
{
    public function googleRedirect()
    {   
            return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {         
       $user=Socialite::driver('google')->user();
       $authUser = User::where('email',$user->email)->first();
        if(isset($authUser)){  
            Session::put('hoten1',$user->name);      
            Session::put('email',$user->email);
            Session::put('google_id',$user->id);
            return redirect()->route('index');
        }else{
            $newUser = new User();
            $newUser->tentaikhoan = 'Google';
            $newUser->hoten = $user->name;
            $newUser->email = $user->email;
            $newUser->level = 1;
            $newUser->google_id = $user->id;
            $newUser->password = bcrypt('');
            $newUser->save();
            Session::put('hoten1',$user->name);
            Session::put('email',$user->email);
            Session::put('google_id',$user->id);         
            return redirect()->route('index');
        }
    } 



    public function FacebookRedirect()
    {
            return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {         
        return 'facebook';
    }
}
