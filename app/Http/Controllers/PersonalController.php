<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PersonalController extends Controller
{
    public function __construct(){
        $this->middleware('web');
        $this->middleware('login');
    }

    public function home(){
        return view('personal.home');
    }
}
