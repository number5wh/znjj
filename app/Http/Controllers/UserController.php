<?php

namespace App\Http\Controllers;

use App\Models\FriendGroup;
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


        return view('user.home');
    }

    public function addFriend(){

    }

    public function getFriends(){
        $friends = FriendGroup::select('name','users')
            ->where('user_id',session('user_id'))
            ->get()
            ->toArray();
//        dd($friends);
        foreach($friends as $friend){
            $groupName[] = $friend['name'];
            $friendId[] = explode(',',$friend['users']);
        }
        dd($groupName,$friendId);

    }
}
