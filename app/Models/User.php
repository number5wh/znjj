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

}
