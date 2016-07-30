<?php

namespace App\Http\Controllers;

use App\Models\FriendGroup;
use App\Models\FriendRequest;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('web');
//        $this->middleware('login');

    }

    //主页
    public function home(){
        //查看好友请求
        $fromId = FriendRequest::select('from')
            ->where('to',session('user_id'))
            ->where('pass',2)//未处理
            ->get();
        foreach($fromId as $v){
            $frphone = $this->getPhoneById($v['from']);
        }
        dd($frphone);




        //获取好友列表
        $fg = $this->getFriends();
        foreach($fg as $v){
            $name[] = $v['name'];
            $friends[] = $v['users'];
        }

        foreach($friends as $a){
            $friends1[] = explode(',',$a);//以,分组取出
        }
        foreach($friends1 as $b){
            $friends2[] = array_filter($b);//去除最后一个null值
        }

        foreach($friends2 as $c){
            foreach($c as $d){
                $phones[][] = $this->getPhoneById($d);
            }
        }

        $data = [
            'name'=>$name,
            'phones'=>$phones,
        ];

        return view('user.home',compact(['data']));
    }


    //添加好友
    public function addFriend(Request $request){
        if($_POST == null){
//            dd(123);
            $groups = $this->getGroupById(session('user_id'));
            return view('user.addFriend',compact('groups',$groups));
        }else{

            //添加到好友请求表

            $to = $this->getIdByPhone($request->phone);
//            dd($to);
            $fr = new FriendRequest;
            $fr->from = session('user_id');
            $fr->to = $to;
            $fr->group = $request->group;
            $fr->save();
            echo "<script>alert('请求已发出！');window.location.href='/user/home';</script>";
        }
    }


    //获取好友列表
    public function getFriends(){
        $friends = FriendGroup::select('name','users')
            ->where('user_id',session('user_id'))
            ->get()
            ->toArray();
        return $friends;
//        foreach($friends as $friend){
//            $groupName[] = $friend['name'];
//            $friendId[] = explode(',',$friend['users']);
//        }
    }


    //通过id得到手机号
    public function getPhoneById($id){
        $phone = User::select('phone')->where('id',$id)->get();
        return $phone[0]->phone;
    }

    //通过手机号得到id
    public function getIdByPhone($phone){
        $id = User::select('id')->where('phone',$phone)->get();
        return $id[0]->id;
    }

    //通过id得到自己建立的好友分组
    public function getGroupById($id){
        //sql查询
//        $groups = FriendGroup::select('name')->where('user_id',$id)->get()->toArray();
//        foreach($groups as $group){
//            $g[] = $group['name'];
//        }
//        return $g;


        //关联关系查询
        $fg = User::find($id)->FriendGroupNames;
        foreach($fg as $v){
            $g[] = $v['name'];
        }
        return $g;
    }
}
