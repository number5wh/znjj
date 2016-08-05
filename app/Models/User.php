<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table='user';
    public $timestamp = true;

    public function FriendGroupNames(){
        return $this->hasMany('App\Models\FriendGroup')->select('name');
    }

    //获取主机所有信息
    public function Hosts(){
        return $this->hasMany('App\Models\Host');
    }

    //获取主机id
    public function getHostId(){
        return $this->hasMany('App\Models\Host')->select('id');

    }

    //获取主机id和name
    public function getHostName(){
        return $this->hasMany('App\Models\Host')->select('id','name');

    }

    //获取快捷分组
    public function EquipmentGroup(){
        return $this->hasMany('App\Models\EquipmentGroup');
    }

    //获取快捷分组名
    public function EquipmentGroupName(){
        return $this->hasMany('App\Models\EquipmentGroup')->select('id','name');
    }


}
