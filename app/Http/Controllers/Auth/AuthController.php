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
        return view('admin.auth.login');
    }

    public function postLogin(Request $request){
        $passWord = md5(trim($request->password));
        $username = trim($request->username);

        $objUser = User::where("username","=",$username)->where("password","=",$passWord)->where('active','=',1)->first();
        if (!empty($objUser)) {
            $request->session()->put('objUser', $objUser);
            return redirect()->route("admins.profile");
            die();
        }else{
            return redirect()->route("auth.login")->with('fail', 'Fail');
        }          
    }

     public function logout(Request $request){
         $request->session()->forget('objUser');
         return redirect()->route("auth.login");
     }

    // public function getUser($id){
        
    //     $objUser = NguoiDung::FindOrFail($id);
    //     echo json_encode($objUser);
    // }

   

    // public function postUser(Request $request){
        
    //     $passWord=$_POST['passwordedit'];
    //     $objAdmin =NguoiDung::where('maso','=','123')->first();
    //     $currentPass =$objAdmin->password;

    //     if($currentPass != $passWord) {
    //         $objAdmin->password=md5($passWord);
    //         $objAdmin->save();
    //         echo json_encode(1);
    //     } else {
    //          echo json_encode('notoke');
    //     }
       
        
    // }

}
