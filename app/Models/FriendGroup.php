<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FriendGroup extends Model
{
    protected $table = 'friend_group';

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
