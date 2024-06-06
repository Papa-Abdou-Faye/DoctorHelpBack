<?php

namespace App\Http\Controllers;

use App\Models\RV;
use App\Models\User;
use App\Models\Terrain;
use App\Models\Antecedent;
use App\Models\Medicament;
use App\Models\Ordennance;
use App\Models\Consultation;
use App\Models\Paraclinique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    public function accueilPatient()
    {
        return view("forPatient.accueil");
    }
    public function profil(){
        $user = User::join('patients', 'patients.user_id', '=', 'users.id')->where('user_id', '=', Auth::user()->id )->first();
        return view('forPatient.accueil', compact('user'));
    }
    public function Antece(){
        $antecedents = Antecedent::where('user_id', '=', Auth::user()->id)->where('supprimer', '=', false)->get();
        return view('forPatient.antecdent', compact('antecedents'));
    }
    public function Terr(){
        $terrains = Terrain::where('user_id', '=', Auth::user()->id)->where('supprimer', '=', false)->get();
        return view('forPatient.terrain', compact('terrains'));
    }
    public function rvforpatient(){
        $rv = RV::where('user_id', '=', Auth::user()->id)->get();
        return view('forPatient.rv', compact('rv'));
    }
    public function dossierforpatient(){
        $consultations = Consultation::latest()->where('user_id', '=', Auth::user()->id)->get();
        if ($consultations->count() > 0) {
            // dd($consultations);
            $consul = Consultation::latest()->where('user_id', '=', Auth::user()->id)->firstOrFail();
            //dd($consul);
            session(['consultation_trouve' => true]);
            // dd(session('consultation_trouve'));
            return view('forPatient.dossiers', compact('consultations','consul'));
        }else{
            $consul = Consultation::latest()->where('user_id', '=', Auth::user()->id)->get();
            session(['consultation_trouve' => false]);
            return view('forPatient.dossiers', compact('consultations','consul') );
        }
    }
    public function voirConsforPatient($id){
        $consultations = Consultation::latest()->where('user_id', '=', Auth::user()->id)->get();
        $consul = Consultation::where('id', '=', $id)->firstOrFail();
        return view('forPatient.dossiers', compact('consultations','consul'));
    }
    public function ordforpatient(){
        $ordennances = Ordennance::latest()->where('user_id', '=', Auth::user()->id)->get();
        if($ordennances->count() > 0){
            $dernierOrd = Ordennance::latest()->where('user_id', '=',  Auth::user()->id)->firstOrFail();
            $ord_medicaments = Medicament::where('ordennance_id', '=', $dernierOrd->id )->get();
            $ord_med_date = Medicament::where('ordennance_id', '=', $dernierOrd->id )->firstOrFail();
            session(['ord_first' => true]);
            return view('forPatient.ordennance', compact('ordennances', 'ord_medicaments', 'ord_med_date'));
        }else{
            session(['ord_first' => false]);
            return view('forPatient.ordennance', compact('ordennances'));
        }
    }
    public function voirOrdforPatient($id){
        $ordennances = Ordennance::latest()->where('user_id', '=', Auth::user()->id)->get();
        $ord_medicaments = Medicament::where('ordennance_id', '=', $id )->get();
        $ord_med_date = Ordennance::where('id', '=', $id )->firstOrFail();
        session(['ord_first' => true]);
    return view('forPatient.ordennance', compact('ordennances', 'ord_medicaments','ord_med_date'));
    }

    public function paraforpatient(){
        $paracliniques = Paraclinique::latest()->where('user_id', '=', Auth::user()->id)->get();
        if($paracliniques->count() > 0){
            $paraclinique = Paraclinique::latest()->where('user_id', '=',  Auth::user()->id)->firstOrFail();
            session(['para_first' => true]);
            return view('forPatient.paraclinique', compact('paracliniques', 'paraclinique'));
        }else{
            session(['ord_first' => false]);
            return view('forPatient.paraclinique', compact('paracliniques'));
        }
    }
    public function voirparaforPatient($id){
        $paracliniques = Paraclinique::latest()->where('user_id', '=', Auth::user()->id)->get();
        $paraclinique = Paraclinique::where('id', '=', $id )->firstOrFail();
        session(['para_first' => true]);
    return view('forPatient.paraclinique', compact('paracliniques', 'paraclinique'));
    }

}
