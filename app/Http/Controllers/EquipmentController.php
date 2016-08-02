<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Host;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class EquipmentController extends Controller
{
    public function __construct(){
        $this->middleware('web');
//        $this->middleware('login');

    }

    public function home(){
        return view('equipment.home');
    }

    //添加主机
    public function addHost1(){
        return view('equipment.addHost');
    }

    public function addHost2(){
        $input = Input::all();
//        echo 1;
        $name = $input['name'];
        $password = $input['password'];
        $res = 0;
        $res  =  $this->checkHost($name,$password);
//        dd($res);
        if($res!='right'){
            exit($res);
        }else{

            //更新主机表
            Host::where('name',$input['name'])
                ->where('password',$input['password'])
                ->update([
                    'user_id'=>session('user_id')
                ]);
            //更新user表
            User::where('id',session('user_id'))->update(['is_admin'=>1]);
            //更新session
            session(['is_admin'=>1]);
            //输出到ajax
            exit($res);
        }
    }

    //验证主机名
    public function checkHost($name,$password){
        $names = Host::select('name')->get()->toArray();
//        dd($names);
        foreach($names as $a){
            $b[] = $a['name'];
        }

        //主机名不对
        if(!in_array($name,$b)){
            return 'wrong host name';
        }else{
            $u = Host::select('user_id')->where('name',$name)->get();
            if($u[0]['user_id']!=0){
                //主机已经登录过了
                return 'already login';
            }

            $correctPass = Host::select('password')->where('name',$name)->get();
            if($password!=$correctPass[0]->password){
                //密码不对
                return 'wrong password';
            }else{
                //信息正确
                return 'right';
            }
        }
    }

    //添加设备(添加那些已被移除的设备)
    public function addEquip1(){
        //
        $hosts = User::find(session('user_id'))->getHostId->toArray();
//        dd($hosts);

        $deleted =null;
        foreach($hosts as $host){
            //不方便
            //$deleted[] = Host::find($host['id'])->equipmentIdDeleted->toArray();

        }
        //dd($deleted);
        /*
         * deleted格式
         array:2 [▼
              0 => array:2 [▼
                0 => array:2 [▼
                  "id" => 1
                  "name" => "厨房灯"
                ]
                1 => array:2 [▼
                  "id" => 2
                  "name" => "卫生间灯"
                ]
              ]
              1 => array:1 [▼
                0 => array:2 [▼
                  "id" => 3
                  "name" => "公司前台"
                ]
              ]
            ]
         *
         * */
        if($deleted == null){
            echo "<script>alert('没有可添加的设备！');window.location.href='/equipment/home';</script>";
        }else{
            return view('equipment.addEquip')->with('deleted',$deleted);
        }

    }

    public function addEquip2()
    {

    }



}
