<?php

namespace App\Http\Controllers;

use App\Models\Abson;
use Illuminate\Http\Request;

class AbsonController extends Controller
{
    //
    public function store(Request $request){
        // cek data
        $cak = Abson::where([
            'id_siswa' => $request->id_siswa,
            'targgal' => date('y-m-d')
        ])->first();
        if($cak){
            return redirect('/consulter')->with('gagal', 'anda sudah abson');
        }
        Abson::create([
            'id_siswa' => $request->id_siswa,
            'targgal' => date('y-m-d')
        ]);
        return redirect('/consulter')->with('success', 'silahkan masuk');
    } 
}
