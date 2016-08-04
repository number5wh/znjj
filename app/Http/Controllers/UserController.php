<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\FriendGroup;
use App\Models\FriendRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('web');
        $this->middleware('login');

    }

    //主页
    public function home(){
        //查看好友请求

        $frphoneAdd = $this->getRequestInfo(2);
        $frphonePass = $this->getRequestInfo(1);
        $frphoneDeny = $this->getRequestInfo(0);


        //获取好友列表
        $fg = $this->getFriends();
//        dd($fg[0]['name']);
//dd($fg);

        if(count($fg) ==1 && $fg[0]['users'] == null){
            $tmp[]=$fg[0]['name'];
            $data['name'] = $tmp;
            $data['phones'] = null;
        }
        else{
            foreach($fg as $v){
                $name[] = $v['name'];
                $friends[] = $v['users'];
            }

//            dd($friends);

            foreach($friends as $a){
                if($a != null){
                    $friends1[] = explode(',',$a);//以,分组取出
                }else{
                    $friends1[] = $a;
                }

            }
//            dd($friends1);
            foreach($friends1 as $b){
//                dd($b);
                if($b!=null){
                    $friends2[] = array_filter($b);//去除最后一个null值
//                    dd($friends2);
                }
                else{
//                    dd($b);
                    $friends2[] = $b;
//
                }
            }
//            dd($friends2);
            foreach($friends2 as $c){
                if($c !=null){
                    foreach($c as $d){
                        $phones[][] = $this->getPhoneById($d);
                    }
                }
                else{
                    $phones[][]=null;
                }
            }

            $data = [
                'name'=>$name,
                'phones'=>$phones,
            ];
        }

        $group = $this->getGroupById(session('user_id'));


        return view('user.home',compact(['data','frphoneAdd','frphonePass','frphoneDeny','group']));
    }

    //获取好友请求信息
    public function getRequestInfo($type){
        if($type == 2){
            $fromId = FriendRequest::select('from')
                ->where('to',session('user_id'))
                ->where('pass',2)//未处理
                ->get()
                ->toArray();
//        dd($fromId);
            if($fromId == null){
                $frphone = null;
            }else{
                foreach($fromId as $v){
                    $frphone[] = $this->getPhoneById($v['from']);
                }
            }
        }else{
            $fromId = FriendRequest::select('to')
                ->where('from',session('user_id'))
                ->where('pass',$type)//1通过 0未通过
                ->get()
                ->toArray();
//        dd($fromId);
            if($fromId == null){
                $frphone = null;
            }else{
                foreach($fromId as $v){
                    $frphone[] = $this->getPhoneById($v['to']);
                }
            }
        }
        return $frphone==null?null:$frphone;
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

    //处理好友请求
    public function friendHandle(){
        $data = Input::all();
//        dd($data);
        $pass = $data['pass'];
        $to = $data['to'];
        $fromPhone = $data['from'];
        $from = $this->getIdByPhone($fromPhone);
//        dd($from);
        if($pass == 1){//通过请求
            //添加到friend表
            $friend = new Friend();
            $friend->userid1 = $from;
            $friend->userid2 = $to;
            $friend->save();


            //friend_group表的更新(添加人和被添加人)

            //添加人
            //获取添加人要添加的分组
            $groupFrom = FriendRequest::select('group')
                ->where('from',$from)
                ->where('to',$to)
                ->where('pass',2)
                ->get()
                ->toArray();
//            dd($groupFrom[0]['group']);


            //获取这组已有好友列表
            $friendList1 = FriendGroup::select('users')
                ->where('user_id',$from)
                ->where('name',$groupFrom[0]['group'])
                ->get()
                ->toArray();
            //再把to加上
            $list1 = $friendList1[0]['users'].$to.",";
            DB::table('friend_group')
                ->where('user_id',$from)
                ->where('name',$groupFrom[0]['group'])
                ->update(['users'=>$list1]);


            //被添加人
            //获取这组已有好友列表
            $groupTo = $data['group'];
            $friendList2 = FriendGroup::select('users')
                ->where('user_id',$to)
                ->where('name',$groupTo)
                ->get()
                ->toArray();
            //加上from
            $list2 = $friendList2[0]['users'].$from.",";
            DB::table('friend_group')
                ->where('user_id',$to)
                ->where('name',$groupTo)
                ->update(['users'=>$list2]);



            //friend_request表的更新

            DB::table('friend_request')
                ->where('from',$from)
                ->where('to',$to)
                ->update(['pass'=>$pass]);

            //返回给ajax信息
            echo 1;

        }elseif($pass == 0){//拒绝
            //friend_request表的更新

            DB::table('friend_request')
                ->where('from',$from)
                ->where('to',$to)
                ->update(['pass'=>$pass]);

            echo 2;
        }elseif($pass == 3){//忽略
            //friend_request表的更新

            DB::table('friend_request')
                ->where('from',$from)
                ->where('to',$to)
                ->where(['pass'=>2])
                ->delete();

            echo 3;
        }
    }

    //好友处理反馈信息
    public function handleResult($from,$to,$pass){
        $toId = $this->getIdByPhone($to);
        FriendRequest::where('from',$from)->where('to',$toId)->where('pass',$pass)->delete();
        echo "<script>window.location.href='/user/home';</script>";
    }


    //添加好友分组
    public function addFriendGroup1(){
        return view('user.addFriendGroup');
    }

    public function addFriendGroup2(Input $input){
        $data = $input::all();

            $friendGroup = new FriendGroup();
            $friendGroup->user_id = $data['user_id'];
            $friendGroup->name = $data['groupName'];
            $friendGroup->save();
            echo 1;
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
        return $phone[0]->phone!=null?$phone[0]->phone:null;
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
