<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EquipmentGroup extends Model
{
    protected $table='equipment_group';

    public function equipments(){
        return $this->hasMany('App\Models\Equipment');
    }
}
