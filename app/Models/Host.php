<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Host extends Model
{
    protected $table='host';

    //获取该主机下的所有设备
    public function equipments(){
        return $this->hasMany('App\Models\Equipment');
    }

    //获取该主机下的所有设备id
    public function equipmentId(){
        return $this->hasMany('App\Models\Equipment')->select('id');
    }

    //获取该主机下的未被移除设备id和name
    public function equipmentIdNotDeleted(){
        return $this->hasMany('App\Models\Equipment')->where('is_deleted',0)->select('id','name');
    }


    //获取该主机下的被移除设备id
    public function equipmentIdDeleted(){
        return $this->hasMany('App\Models\Equipment')->where('is_deleted',1)->select('id','name');
    }
}
