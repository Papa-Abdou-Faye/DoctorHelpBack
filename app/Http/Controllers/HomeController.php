<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Consultation;
use App\Models\RV;
use App\Models\PersoQueu;

class HomeController extends Controller
{


    public function dropdown(){
        // les rendez-vous
        $rv = RV::latest()->where('medecin_id', '=', Auth::user()->id)->join('users', 'users.id', '=', 'r_v_s.user_id')->where('daterv','=', date('y/m/d'))->select('r_v_s.daterv', 'r_v_s.daterv', 'r_v_s.heurerv', 'r_v_s.note', 'r_v_s.user_id','users.prenom', 'users.nom', 'r_v_s.created_at' )->orderBy('r_v_s.created_at', 'desc')->get();
        $nbrRV =  $rv->count();
        // les consultations
        $daterv =  date('d/m/Y');
        $CON = Consultation::where('medecinuser_id', '=', Auth::user()->id)->where('datecons', '=',date('y/m/d'))->get();
        $nbrCON = $CON->count();
         // Queu
         $q = DB::table('listpatiens')->where('medecin_id', '=', Auth::user()->id )->where('dateliste', '=', date('y/m/d'))->get();
         $k = 0;
         for ($i=0; $i < $q->count() ; $i++) {
             $listes[$i] = PersoQueu::where('listpatien_id', '=', $q[$i]->id)->get();
         }
         if($q->count() > 0){
             for($i=0; $i < count($listes) ; $i++){
                 $k += $listes[$i]->count();
             }
             $list = collect($listes);
             $z = -1;
             foreach($list as $L){
                 foreach($L as $l){
                     $z++;
                     $val[$z] = $l;
                 }
             }
             $liste = collect($val)->sortBy('created_at');
             session(['patientt_first' => true]);
         }else{
             $liste = null;
             session(['patientt_first' => false]);
         }
         return response()->json([
            "status" => 200,
            "nombreRV" => $nbrRV,
            "nombreConsultation" => $nbrCON,
            "queu" => $k,

            // "rv" => $rv,
            // "daterv" => $daterv,
            // "liste" => $liste,

        ]);

    }


    // ========================== Courbe ==============================
    public function courbe(){
        // les rendez-vous par mois
        $rv = RV::latest()->where('medecin_id', '=', Auth::user()->id)->join('users', 'users.id', '=', 'r_v_s.user_id')->where('daterv','=', date('y/m/d'))->select('r_v_s.daterv', 'r_v_s.daterv', 'r_v_s.heurerv', 'r_v_s.note', 'r_v_s.user_id','users.prenom', 'users.nom', 'r_v_s.created_at' )->orderBy('r_v_s.created_at', 'desc')->get();
        $nbrRV =  $rv->count();
        // les consultations par mois
        $CON = Consultation::where('medecinuser_id', '=', Auth::user()->id)->where('datecons', '=',date('y/m/d'))->get();
        $nbrCON = $CON->count();
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


}
