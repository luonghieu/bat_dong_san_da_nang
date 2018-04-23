<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function __construct()
    {
        
    }
    
    public function login()
    {
        return view('admin.auth.login');
    }

    // public function postLogin(Request $request){
    //     $passWord = md5(trim($request->password));

    //     $objUser = NguoiDung::where("maso","=",'123')->where("password","=",$passWord)->where('active','=',1)->first();
    //     if (!empty($objUser)) {
    //         $id=$objUser->id;
    //         $request->session()->put('id', $id);
    //         return redirect('/giaovien');
    //         die();
    //     }else{
    //         $request->session()->flash('msg','Tài khoản không đúng');
    //         return redirect()->route("admin.user.getlogin");
    //     }          
    // }

    //  public function login($maso,$password){
    //     $passWord = md5(trim($password));

    //     $objUser = NguoiDung::where("maso","like","$maso")->where("password","like","$passWord")->where('active','=',1)->get();
    //     if (!empty($objUser)) {
    //        echo json_encode($objUser[0]);
    //     }         
    // }


    // public function logout(Request $request){
    //     $request->session()->forget('id');
    //     return redirect()->route("admin.user.getlogin");
    // }

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

    // public function getGiaoVien()
    // {
    //     $giaoVien = GiaoVien::select(['giaovien.hoten as tengiaovien','giaovien.id as maso','nguoidung.password as password','nguoidung.active as active'])->join('nguoidung','giaovien.id','=','nguoidung.maso')->get();
    //     return view('admin.auth.giaovien',['giaoVien'=>$giaoVien]);
    // }

    // public function trangThaiGiaoVien($nid){
    //     $objItem =NguoiDung::where('maso','=',$nid)->first();
    //     if($objItem->active == '0'){
    //         $objItem->active = '1';
    //         $objItem->save();
    //         echo "<a href='javascript:void(0)' onclick='getTrangThaiGV( {$nid});'>
    //              <img src='/storage/app/file/active.gif'/>
    //         </a>";
    //     }else{
    //         $objItem->active = '0';
    //         $objItem->save();
    //         echo "<a href='javascript:void(0)' onclick='getTrangThaiGV( {$nid});'>
    //              <img src='/storage/app/file/deactive.gif'/>
    //         </a>";
    //     }
    // }

    // public function editpassGV($id){
        
    //     $giaoVien = GiaoVien::select(['giaovien.hoten as tengiaovien','giaovien.id as maso','nguoidung.password as password','nguoidung.active as active'])->join('nguoidung','giaovien.id','=','nguoidung.maso')->where('maso','=',$id)->get();
    //     echo json_encode($giaoVien[0]); 
    // }

    //  public function postEditPassGV(){
        
    //     $maso = $_POST['masoGV'];
    //     $passWord=$_POST['passwordGV'];
    //     $objGV =NguoiDung::where('maso','=',$maso)->first();
    //     $currentPass =$objGV->password;

    //     if($currentPass != $passWord) {
    //         $objGV->password=md5($passWord);
    //         $objGV->save();
    //         echo json_encode(1);
    //     } else {
    //          echo json_encode('notoke');
    //     }
        
        
    // }

    // //HOCSINH
    //  public function getHocSinh()
    // {
    //     $hocSinh = HocSinh::select(['hocsinh.hoten as tenhocsinh','hocsinh.id as maso','nguoidung.password as password','nguoidung.active as active'])->join('nguoidung','hocsinh.id','=','nguoidung.maso')->get();
    //     return view('admin.auth.hocsinh',['hocSinh'=>$hocSinh]);
    // }


    // public function editpassHS($id){
        
    //     $hocSinh = HocSinh::select(['hocsinh.hoten as tenhocsinh','hocsinh.id as maso','nguoidung.password as password','nguoidung.active as active'])->join('nguoidung','hocsinh.id','=','nguoidung.maso')->where('maso','=',$id)->get();
    //     echo json_encode($hocSinh[0]); 
    // }

    // public function postEditPassHS(){
        
    //     $maso = $_POST['masoHS'];
    //     $passWord=$_POST['passwordHS'];
    //     $objHS =NguoiDung::where('maso','=',$maso)->first();
    //     $currentPass =$objHS->password;

    //     if($currentPass != $passWord) {
    //         $objHS->password=md5($passWord);
    //         $objHS->save();
    //         echo json_encode(1);
    //     } else {
    //          echo json_encode('notoke');
    //     }
        
        
    // }



    //  public function trangThaiHocSinh($nid){
    //     $objItem =NguoiDung::where('maso','=',$nid)->first();
    //     if($objItem->active == '0'){
    //         $objItem->active = '1';
    //         $objItem->save();
    //         echo "<a href='javascript:void(0)' onclick='getTrangThaiGV( {$nid});'>
    //              <img src='/storage/app/file/active.gif'/>
    //         </a>";
    //     }else{
    //         $objItem->active = '0';
    //         $objItem->save();
    //         echo "<a href='javascript:void(0)' onclick='getTrangThaiGV( {$nid});'>
    //              <img src='/storage/app/file/deactive.gif'/>
    //         </a>";
    //     }
    // }
}
