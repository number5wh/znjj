<?php

namespace App\Http\Controllers;

use App\Models\EquipmentGroup;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class QuickController extends Controller
{
    public function __construct(){
        $this->middleware('web');
        $this->middleware('login');
    }

    public function home(){
        $quick = User::find(session('user_id'))->EquipmentGroupName->toArray();
//        dd($quick[0]['name']);
        return view('quick.home',compact(['quick']));
    }

    public function groupInfo($id){
        $e = EquipmentGroup::select('equipments')->where('id',$id)->get()->toArray();
        dd($e[0]['equipments']);
    }



    
}
