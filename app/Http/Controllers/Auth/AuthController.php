<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function __construct()
    {
        
    }
    
    public function login()
    {
        if (isLogin()) {
            return redirect()->route("auth.profile");
        }
        return view('admin.auth.login');
    }
    
    public function profile()
    {
        return view('admin.auth.profile');
    }

    public function postLogin(Request $request){
        $passWord = md5(trim($request->password));
        $username = trim($request->username);

        $objUser = User::where("username","=",$username)->where("password","=",$passWord)->where('active','=',1)->first();
        if (!empty($objUser)) {
            $request->session()->put('objUser', $objUser);
            return redirect()->route("auth.profile")->with('success', 'Login success!');
            die();
        }else{
            return redirect()->route("auth.login")->with('fail', 'Fail');
        }          
    }

     public function logout(){
         session()->forget('objUser');
         return redirect()->route("auth.login");
     }
}
