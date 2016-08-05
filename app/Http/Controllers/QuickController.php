<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\EquipmentGroup;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class QuickController extends Controller
{
    public function __construct(){
        $this->middleware('web');
        $this->middleware('login');
    }

    public function home(){
        $quick = User::find(session('user_id'))->EquipmentGroupName->toArray();
//        dd($quick[0]['name']);
//        dd($quick);
        return view('quick.home',compact(['quick']));
    }

    //添加分组
    public function addGroup1(){
        $eq = new EquipmentController();
        $equip = $eq->getHostEquip();
        $equip2 = $eq->getDistributeEquip();
//        foreach($equip as $a){
//            foreach($a as $b){
//                $equip2[] = $b;
//            }
//        }
//        dd($equip,$equip2);
        return view('quick.addGroup',compact(['equip','equip2']));
    }

    public function addGroup2(Input $input)
    {
        $data = $input::all();

        $name = $data['name'];
        $equipments = '';
        foreach($data['equip_id'] as $id){
            $equipments.=$id.',';
        }
        $group = new EquipmentGroup();
        $group->name = $name;
        $group->equipments = $equipments;
        $group->user_id = session('user_id');
        $group->save();
        echo "<script>alert('添加分组成功！');window.location.href='/quick/home';</script>";
    }

    //删除分组
    public function deleteGroup1(){
        $group = EquipmentGroup::where('user_id',session('user_id'))->get()->toArray();
        return view('quick.deleteGroup',compact(['group']));
    }

    public function deleteGroup2(Input $input){
        $data = $input::all();
        $id = $data['groupId'];
        if($id !=null){
            foreach($id as $a){
                EquipmentGroup::where('id',$a)->delete();
            }
        }
        echo "<script>alert('删除分组成功！');window.location.href='/quick/home';</script>";

    }


    //获取组内设备信息
    public function groupInfo($id){
        $uid = EquipmentGroup::select('user_id')->where('id',$id)->get()->toArray();
        if(session('user_id') != $uid[0]['user_id']){
            echo "<script>alert('你没有这个权限！');window.location.href='/quick/home';</script>";
        }

        $groupName = EquipmentGroup::select('name')->where('id',$id)->get()->toArray();
        $e = EquipmentGroup::select('equipments')->where('id',$id)->get()->toArray();
//        dd($e[0]['equipments']);
        if($e[0]['equipments'] == null){
            $equip = null;
            $equipInfo = null;

        }else{
            $a[] = explode(',',$e[0]['equipments']);
            foreach($a as $b)
            $equip = array_filter($b);
            foreach($equip as $c){
                $equipInfo[] = Equipment::find($c)->toArray();
            }

//            dd($equipInfo);
            return view('quick.groupDetail',compact(['equipInfo','groupName','id']));
        }
    }

    //添加设备到分组
    public function addEquip1($id){
        $group = EquipmentGroup::where('id',$id)->where('user_id',session('user_id'))->get()->toArray();
//        dd($group);
        $equipId = array_filter(explode(',',$group[0]['equipments']));//去除逗号再去除最后一个null
//        dd($e);

        $equipObj = new EquipmentController();
        $equip = $equipObj->getHostEquip();
//        dd($equip,$equipId);
        $equip2 = $equipObj->getDistributeEquip();

        return view('quick.addEquip',compact('equip','equipId','group','equip2'));
    }

    public function addEquip2(Input $input){
        $data = $input::all();
        $groupId = $data['group_id'];
        $equipId = $data['equip_id'];

        $newEquip = EquipmentGroup::select('equipments')->where('id',$groupId)->where('user_id',session('user_id'))
            ->get()->toArray();

        foreach($equipId as $v){
            $newEquip[0]['equipments'].=$v.',';
        }
      //  $newEquip = $oldEquip.$equipId;

//        dd($newEquip);

        EquipmentGroup::where('id',$groupId)->where('user_id',session('user_id'))
            ->update(['equipments'=>$newEquip[0]['equipments']]);
        echo "<script>alert('添加设备成功！');window.location.href='/quick/home';</script>";

    }

    //从分组中删除设备
    public function deleteEquip1($id){
        $group = EquipmentGroup::where('id',$id)->where('user_id',session('user_id'))->get()->toArray();
//        dd($group);
        $equipId = array_filter(explode(',',$group[0]['equipments']));//去除逗号再去除最后一个null
        foreach($equipId as $v){
            $eName[] = Equipment::select('name')->where('id',$v)->get()->toArray();
        }
        foreach($eName as $a){
            $equipName[] = $a[0]['name'];
        }

//        dd($equipName);
        return view('quick.deleteEquip',compact(['group','equipId','equipName']));
    }

    public function deleteEquip2(Input $input){
        $data = $input::all();
        $id = $data['group_id'];
        $equipId = $data['equip_id'];

        $e = implode(',',$equipId).",";

        $group = EquipmentGroup::where('id',$id)->where('user_id',session('user_id'))->get()->toArray();
        //将要删除的id串替换为空
        $newEquipId = str_replace($e,'',$group[0]['equipments']);
        EquipmentGroup::where('id',$id)->where('user_id',session('user_id'))
            ->update(['equipments'=>$newEquipId]);
        echo "<script>alert('删除成功！');window.location.href='/quick/home';</script>";

    }

    //开关设备
    public function singleSwitch(Input $input){
        $data = $input::all();
        $equipId = $data['equip_id'];
        $status = $data['status'];
        //$groupId = $data['group_id'];
        Equipment::where('id',$equipId)
            ->update(['status'=>$status]);
        echo 1;
    }

    public function allSwitch($id,$status){
        $e = EquipmentGroup::select('equipments')->where('id',$id)->where('user_id',session('user_id'))->get()->toArray();
        $equip = array_filter(explode(',',$e[0]['equipments']));
        foreach($equip as $v){
            Equipment::where('id',$v)->update(['status'=>$status]);
        }
        exit ("<script>alert('操作成功！');window.location.href='/quick/groupInfo/{$id}';</script>");
    }

    
}
