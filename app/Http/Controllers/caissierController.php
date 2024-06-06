<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class caissierController extends Controller
{
    //
    public function ac_caisse(){
        return view('forCaissier.ac_caisse');
    }
}
