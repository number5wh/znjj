<?php

namespace App\Http\Controllers;

use App\Models\EquipDistribute;
use App\Models\Equipment;
use App\Models\EquipmentGroup;
use App\Models\Host;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class EquipmentController extends Controller
{
    public function __construct(){
        $this->middleware('web');
        $this->middleware('login');

    }

    public function home(){
//        dd(session()->all());
        //主机部分
        $equip = $this->getHostEquip();

        //被分配的部分
        $equip2 = $this->getDistributeEquip();
//        dd($equip);

        return view('equipment.home',compact(['equip','equip2']));
    }
    //主机和设备关联信息
    public function getHostEquip(){
        $hosts = User::find(session('user_id'))->getHostName->toArray();
        //dd($hosts);
        $c=null;$equip=null;
        foreach($hosts as $host){
            $equip[$host['name']] = Host::find($host['id'])->equipmentIdNotDeleted->toArray();
        }
        return $equip;
    }

    //获取被分配的设备信息
    public function getDistributeEquip(){
        $group = EquipDistribute::where('to',session('user_id'))->select('id','from','to','equipments')->get()->toArray();
        if($group == null){
            return null;
        }
        $equipId = array_filter(explode(',',$group[0]['equipments']));

        $equip = null;
        foreach($equipId as $a){
            $equip[] = Equipment::find($a)->toArray();
        }
        return $equip;
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
            echo $res;
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
//            dd(session('is_admin'));
            //输出到ajax
            echo $res;
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
        $c = null;

        $deleted =null;
        foreach($hosts as $host){
            //不方便
            $deleted[] = Host::find($host['id'])->equipmentIdDeleted->toArray();

        }
        //        dd($deleted);

        /*
         * deleted格式
          array:2 [▼
          0 => array:4 [▼
            "id" => 2
            "name" => "卫生间灯"
            "host_id" => 1
            "host_name" => "host1"
          ]
          1 => array:4 [▼
            "id" => 3
            "name" => "公司前台"
            "host_id" => 2
            "host_name" => "host2"
          ]
        ]
         *
         * */
        foreach($deleted as $a){
//            dd($a);
            foreach($a as $b){
                $res =  DB::select("select a.host_id host_id,b.name host_name from equipment a left join host b on a.host_id=b.id where a.id=?",[$b['id']]);
                $b['host_id'] =$res[0]->host_id;
                $b['host_name'] = $res[0]->host_name;
                $c[] = $b;
            }
        }
//        dd($c);
        if($c == null){
            echo "<script>alert('没有可添加的设备！');window.location.href='/equipment/home';</script>";
        }else{

            return view('equipment.addEquip')->with('deleted',$c);
        }


    }

    public function addEquip2($id)
    {
        Equipment::where('id',$id)->update([
            'is_deleted'=>0
        ]);
        echo "<script>alert('添加成功！');window.location.href='/equipment/addEquip1';</script>";
    }

    //移除设备
    public function deleteEquip1(){
        $equip = $this->getHostEquip();
        return view('equipment.deleteEquip')->with('equip',$equip);
    }

    public function deleteEquip2(Input $input){
        $deleteId = $input::all()['equip_id'];
        foreach($deleteId as $id){
            Equipment::where('id',$id)->update(['is_deleted'=>1]);
        }
        echo "<script>alert('移除成功！');window.location.href='/equipment/home';</script>";
    }

    //切换查看方式
    public function changeWatch($type){
        if($type == 1){
            return EquipmentController::home();
        }else{
            return EquipmentController::quick();
        }
    }

    public function quick(){
        $equips  = null;
        $equips = EquipmentGroup::where('user_id',session('user_id'))->get()->toArray();
        if($equips == null){
            echo "<script>alert('您还没有便捷分组！');window.location.href='/equipment/home';</script>";
            die;
        }
        foreach($equips as $v){
            $eid[] = array_filter(explode(',',$v['equipments']));
        }
//        dd($eid);
       for($i=0;$i<count($eid);$i++){
           for($j=0;$j<count($eid[$i]);$j++){
               $ename[$i][] = Equipment::select('name')->where('id',$eid[$i][$j])->get()->toArray();
           }
       }
//dd($ename);
        for($k=0;$k<count($ename);$k++){
            for($a=0;$a<count($ename[$k]);$a++){
                $equipName[$k][] = $ename[$k][$a][0]['name'];
            }
        }
//        dd($equipName);

        for($i=0;$i<count($equips);$i++){
            $equips[$i]['equip_name'] = $equipName[$i];
            unset($equips[$i]['equipments'],$equips[$i]['created_at'],$equips[$i]['updated_at']);
        }
//        dd($equips);
        return view('equipment.quick',compact('equips'));
    }
}
