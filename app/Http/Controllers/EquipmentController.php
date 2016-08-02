<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class EquipmentController extends Controller
{
    public function __construct(){
        $this->middleware('web');
//        $this->middleware('login');

    }

    public function home(){
        return view('equipment.home');
    }


}
