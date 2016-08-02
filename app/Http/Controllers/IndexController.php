<?php

namespace App\Http\Controllers;

use App\Models\FriendGroup;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class IndexController extends Controller
{

    //设置中间件
    public function __construct(){
        $this->middleware('web');
    }

    //登录及注册界面
    public function index(){
        return view('index');
    }

    //注册
    public function register(Request $request){
        $this->validate($request,[
            'phone'=>'required|numeric',
            'password'=>'required',
            'password2'=>'required',
        ]);
        $phone = $request->phone;
        $password = $request->password;
        $password2 = $request->password2;
        if($this->isRegistered($phone)){
            echo "<script> alert('手机号已经注册过了');parent.location.href='/'; </script>";
            die;
        }
        if(!is_numeric($phone) || strlen($phone)!=11){
            return view('/');
        }
        if(strlen($password) <6 || $password != $password2){
            return view('/');
        }
        $user = new User();
        $user->phone= $phone;
        $user->password = md5($password);
        $user->save();

        //添加默认分组
        $fg = new FriendGroup();
        $fg->user_id = $this->getId($phone);
        $fg->name = '默认';
        $fg->save();
        echo "<script> alert('注册成功');parent.location.href='/'; </script>";
    }

    //登录
    public function login(Request $request){
        $this->validate($request,[
            'phone'=>'required|numeric',
            'password'=>'required',
        ]);
        $phone = $request->phone;
        $password = $request->password;
        if(!$this->isRegistered($phone)){
            echo "<script> alert('帐号不存在！');parent.location.href='/'; </script>";
            die;
        }else{
            if($this->checkLogin($phone,$password) == false){
                echo "<script> alert('密码错误！');parent.location.href='/'; </script>";
                die;
            }else{
                $is_admin = $this->getIsAdmin($this->getId($phone));
                session(['user_id'=>$this->getId($phone),'phone'=>$phone,'is_admin'=>$is_admin]);
                echo "<script>window.location.href='/user/home';</script>";
            }
        }
    }

    //获取用户
    private function getUser()
    {
        $phones = User::select('phone')->get()->toArray();
        foreach($phones as $phone){
            $data[] = $phone['phone'];
        }
//        dd($data);
        return $data;
    }

    //判断手机号是否注册过
    //http://www.znjj.com/isRegistered/11111111111
    private function isRegistered($phone){
        $phones = $this->getUser();
//        dd($phones);
        if(in_array($phone,$phones)){
            return 1;
        }else{
            return 0;
        }
    }
    //获取用户名密码
    private function checkLogin($phone,$password){
        $password1 = User::select('password')
            ->where('phone',$phone)
            ->get()
            ->toArray();
//        dd($password1);
        if(md5($password) != $password1[0]['password']){
            return false;
        }else{
            return true;
        }
    }

    //获取id
    private function getId($phone){
        $id = DB::select("select id from user where phone='{$phone}'");
       return $id[0]->id;
    }

    //是否是管理员
    private function getIsAdmin($id){
        $isAdmin = DB::select("select is_admin from user where id=$id");
        return $isAdmin[0]->is_admin;
    }
}
