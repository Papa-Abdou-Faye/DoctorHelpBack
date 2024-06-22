<?php

use App\Models\RV;
use App\Models\User;
use App\Models\Medecin;
use App\Models\Secretaire;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AbsonController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\medecinController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\caissierController;
use App\Http\Controllers\secretaireController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('auth.login');
// });
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/home', function () {
if (Auth::check()) {
    if (Auth::user()->role == 'ADMIN') {
        return view('forAdmin.accueil');
    } elseif (Auth::user()->role == 'MEDECIN' || Auth::user()->role == 'MEDECINCHEF') {
        return redirect('/acc');
    } elseif (Auth::user()->role == 'PATIENT') {
        $user = User::join('patients', 'patients.user_id', '=', 'users.id')->where('users.id', '=', Auth::user()->id )->first();
        return view('forPatient.accueil', compact('user'));
    }elseif(Auth::user()->role == 'SECRETAIRE'){
        $secretaires = Secretaire::where('user_id', '=', Auth::user()->id)->firstOrFail();
        $medecins = DB::table('medecins')->where('id_secretaire1', '=',  $secretaires->id)->orwhere('id_secretaire2', '=',  $secretaires->id)->orwhere('id_secretaire3', '=',  $secretaires->id)->get();
       // dd($medecins);
        for( $i = 0; $i < $medecins->count(); $i++){
            $med[$i] = DB::table('users')->where('id', '=', $medecins[$i]->user_id)->first();
        }
        $z = -1;
        $y = -1;
        for( $j = 0; $j <$medecins->count(); $j++){
           // $r = RV::where('medecin_id', '=', $med[$j]->id)->where('daterv','=', date('y/m/d'))->get();
            $r = RV::where('medecin_id', '=', $med[$j]->id)->where('daterv','=', date('y/m/d'))->join('users', 'users.id', '=', 'r_v_s.medecin_id')->select('users.nom', 'r_v_s.heurerv','r_v_s.id','r_v_s.daterv' )->get();
            $r2 = DB::table('r_v_s')->where('medecin_id', '=', $med[$j]->id)->where('daterv','=', date('y/m/d'))->join('users', 'users.id', '=', 'r_v_s.user_id')->get();
            //dd($r);
            foreach ($r as $value) {
                $z++;
                $rvs[$z] = $value;
            }
            foreach ($r2 as $v) {
                $y++;
                $rvs2[$y] = $v;
            }
        }
        if (empty($rvs)) {
           $rv = RV::where('medecin_id', '=', '-1')->get();
           $rvs2[-1] = 0;
           $daterv = date("d-m-Y");
           return view('forSecretaire.accueil', compact('rv','rvs2','daterv'));
        }else{
            $rv = collect($rvs);
            $daterv = date('d-m-Y',strtotime ( $rvs[$z]->daterv));
            return view('forSecretaire.accueil', compact('rv','rvs2','daterv'));
        }
    }elseif (Auth::user()->role == 'INFIRMIER') {
        return redirect('/accInf');
    }elseif (Auth::user()->role == 'CAISSIER') {
        return redirect('/ac_caissier');
    }
}
    // dd(Auth::user());
})->middleware('auth');

// Route::get('/', function () {
//     return view('formulaire');
// });

// // route Admin
//Route::post('/login', [AdminController::class, 'loginn'])->name('log.connexion');
Route::post('/adAcc', [AdminController::class, 'accueil'])->name('acc.admin')->middleware('auth')->middleware('admin');
Route::get('/insMed', [AdminController::class, 'insMed'])->name('inscrir.med');
Route::post('/insMedecin', [AdminController::class, 'ajouterMedecin'])->name('enregisterMed.admin');
//  Route::get('/insmed', [AdminController::class, 'regMed'])->name('regMed.admin');
Route::get('/listMed', [AdminController::class, 'listeMedecin'])->name('list.med')->middleware('auth')->middleware('admin');
Route::get('/pageqrcode', [AdminController::class, 'page'])->name('pageqrcode.admin')->middleware('auth')->middleware('admin');
Route::post('/qrcode', [AdminController::class, 'generer'])->name('qrcode_generer.admin')->middleware('auth')->middleware('admin');
Route::get('/qrList', [AdminController::class, 'qrLister'])->name('qrList.admin')->middleware('auth')->middleware('admin');
Route::get('/anomalie', [AdminController::class, 'anomalie'])->name('anomalie.admin')->middleware('auth')->middleware('admin');
Route::post('/enre-anomalie', [AdminController::class, 'ajoutAnomalie'])->name('enregistrerAnomalie.admin')->middleware('auth')->middleware('admin');
Route::get('/adAcc', [AdminController::class, 'accueil'])->name('acc.admin')->middleware('auth')->middleware('admin');
Route::get('/essaie', [AdminController::class, 'index'])->name('essaie')->middleware('auth')->middleware('admin');
Route::get('/transfertVar/{varId}', [AdminController::class, 'show'])->name('transfertVar.show')->middleware('auth')->middleware('admin');
//stricture
Route::get('/stricture', [AdminController::class, 'stricture'])->name('stricture');
Route::post('/insStric', [AdminController::class, 'ajouterStricture'])->name('ajouterStricture');

// route medcin
// Route::get('/acc', [medecinController::class, 'accMed'])->name('acc.med')->middleware('auth')->middleware('personnelSoignant');
Route::get('/accMedAvecCalretour', [medecinController::class, 'accMedAvecCalretour'])->middleware('auth');
Route::get('/accAvecCal', [medecinController::class, 'accMedAvecCal'])->middleware('auth');
Route::get('/book', [medecinController::class, 'Book'])->name('book')->middleware('auth')->middleware('personnelSoignant');
Route::get('/historique', [medecinController::class, 'history'])->name('hist.med')->middleware('auth')->middleware('personnelSoignant');
Route::get('/consultation', [medecinController::class, 'consultation'])->name('consultation.med')->middleware('auth');
Route::get('/inscrir', [medecinController::class, 'inscrir'])->name('ins.med')->middleware('auth')->middleware('personnelSoignant');
Route::post('/insPatient', [medecinController::class, 'inscrirPatient'])->name('insPatient')->middleware('auth')->middleware('personnelSoignant');
//agenda
Route::get('/agenda', [medecinController::class, 'agenda'])->name('agenda')->middleware('auth')->middleware('personnelSoignant');
// documentation
Route::get('/doc', [medecinController::class, 'documentation'])->name('doc')->middleware('auth')->middleware('personnelSoignant');
Route::get('supUser/{id}', [medecinController::class, 'supUser'])->middleware('auth')->middleware('personnelSoignant');
// crud
Route::get('consul/{id}', [medecinController::class,'consul'])->middleware('auth')->middleware('personnelSoignant');
Route::get('consul2/{id}', [medecinController::class,'consul2'])->middleware('auth')->middleware('personnelSoignant');
//consultation
Route::get('/info', [medecinController::class,'infoPatient'])->name('info')->middleware('auth')->middleware('personnelSoignant');
Route::post('/attr', [medecinController::class,'attCarte'])->name('attCarte')->middleware('auth')->middleware('personnelSoignant');
Route::post('/enrAllergies', [medecinController::class,'enrAllergies'])->name('enrAllergies')->middleware('auth')->middleware('personnelSoignant');
// Registre
Route::get('/register', [medecinController::class,'registerPatient'])->name('register.med')->middleware('auth')->middleware('personnelSoignant');
Route::post('/enrReg', [medecinController::class,'enrReg'])->name('enrConReg')->middleware('auth')->middleware('personnelSoignant');
Route::get('voirReg/{id}', [medecinController::class,'voirReg'])->middleware('auth')->middleware('personnelSoignant');
// Details consultation
Route::get('detailcons/{id}', [medecinController::class,'detailcon'])->middleware('auth')->middleware('personnelSoignant');
Route::get('/infoDetail', [medecinController::class,'infoDetailPatient'])->name('infoDetail')->middleware('auth')->middleware('personnelSoignant');
Route::get('/consDetail', [medecinController::class,'consDetailPatient'])->name('consDetail')->middleware('auth')->middleware('personnelSoignant');
Route::get('voirConsDetail/{id}', [medecinController::class,'voirConsDetail'])->middleware('auth')->middleware('personnelSoignant');
Route::get('/ordDetail', [medecinController::class,'ordDetailPatient'])->name('ordDetail')->middleware('auth')->middleware('personnelSoignant');
Route::post('/enrOrdDetail', [medecinController::class,'enrOrdDetail'])->name('enrOrdDetail')->middleware('auth')->middleware('personnelSoignant');
Route::get('voirOrdDetail/{id}', [medecinController::class,'voirOrdDetail'])->middleware('auth')->middleware('personnelSoignant');
//rdossier
Route::get('/dossier', [medecinController::class,'dossierPatient'])->name('dossier')->middleware('auth')->middleware('personnelSoignant');
Route::post('/enrCon', [medecinController::class,'enrCon'])->name('enrCon')->middleware('auth');
Route::get('voirCons/{id}', [medecinController::class,'voirCons'])->middleware('auth')->middleware('personnelSoignant');
//Ordonnance
Route::get('/ordonnance', [medecinController::class,'ordonnancePatient'])->name('ordonnance')->middleware('auth')->middleware('personnelSoignant');
Route::post('/enrOrd', [medecinController::class,'enrOrd'])->name('enrOrd')->middleware('auth')->middleware('personnelSoignant');
Route::get('voirOrd/{id}', [medecinController::class,'voirOrd'])->middleware('auth')->middleware('personnelSoignant');
//paraclinique
Route::get('/paraclinique', [medecinController::class,'paracliniquePatient'])->name('paraclinique')->middleware('auth')->middleware('personnelSoignant');
Route::post('/enrparaclinique', [medecinController::class,'enrparaclinique'])->name('enrparaclinique')->middleware('auth')->middleware('personnelSoignant');
Route::get('voirparaclinique/{id}', [medecinController::class,'voirparaclinique'])->middleware('auth')->middleware('personnelSoignant');
// paraclinique Biologique
Route::get('/paraBio', [medecinController::class,'paraBioPatient'])->name('paraBio')->middleware('auth')->middleware('personnelSoignant');
Route::post('/enrparaBio', [medecinController::class,'enrparaBio'])->name('enrparaBio')->middleware('auth')->middleware('personnelSoignant');
Route::get('voirparaBio/{id}', [medecinController::class,'voirparaBio'])->middleware('auth')->middleware('personnelSoignant');
//certificat de visite medical
Route::get('/cvmedical', [medecinController::class,'cvmedicalPatient'])->name('cvmedical')->middleware('auth')->middleware('personnelSoignant');
Route::post('/enrcvmedical', [medecinController::class,'enrcvmedical'])->name('enrcvmedical')->middleware('auth')->middleware('personnelSoignant');
Route::get('voircvmedical/{id}', [medecinController::class,'voircvmedical'])->middleware('auth')->middleware('personnelSoignant');
//certificat de visite medical
Route::get('/ccvmedical', [medecinController::class,'ccvmedicalPatient'])->name('ccvmedical')->middleware('auth')->middleware('personnelSoignant');
Route::post('/enrccvmedical', [medecinController::class,'enrccvmedical'])->name('enrccvmedical')->middleware('auth')->middleware('personnelSoignant');
Route::get('voirccvmedical/{id}', [medecinController::class,'voirccvmedical'])->middleware('auth')->middleware('personnelSoignant');
//certificat medical
Route::get('/cM', [medecinController::class,'cMPatient'])->name('cM')->middleware('auth')->middleware('personnelSoignant');
Route::post('/enrcM', [medecinController::class,'enrcM'])->name('enrcM')->middleware('auth')->middleware('personnelSoignant');
Route::get('voircM/{id}', [medecinController::class,'voircM'])->middleware('auth')->middleware('personnelSoignant');
//certificat medical plus
Route::get('/cMplus', [medecinController::class,'cMplusPatient'])->name('cMplus')->middleware('auth')->middleware('personnelSoignant');
Route::post('/enrcMplus', [medecinController::class,'enrcMplus'])->name('enrcMplus')->middleware('auth')->middleware('personnelSoignant');
Route::get('voircMplus/{id}', [medecinController::class,'voircMplus'])->middleware('auth')->middleware('personnelSoignant');
//certificat medical plus
Route::get('/cMrepos', [medecinController::class,'cMreposPatient'])->name('cMrepos')->middleware('auth')->middleware('personnelSoignant');
Route::post('/enrcMrepos', [medecinController::class,'enrcMrepos'])->name('enrcMrepos')->middleware('auth')->middleware('personnelSoignant');
Route::get('voircMrepos/{id}', [medecinController::class,'voircMrepos'])->middleware('auth')->middleware('personnelSoignant');
// rv
Route::get('/rv', [medecinController::class,'rvPatient'])->name('rv')->middleware('auth')->middleware('personnelSoignant');
Route::post('/enrRv', [medecinController::class,'enrRv'])->name('enrRv')->middleware('auth')->middleware('personnelSoignant');
Route::post('/rptRv', [medecinController::class,'rptRv'])->name('rptRv')->middleware('auth')->middleware('personnelSoignant');
Route::get('supRv/{id}', [medecinController::class,'supRv'])->middleware('auth');
// antecedent
Route::get('/antecedent', [medecinController::class,'antecedentPatient'])->name('antecedent')->middleware('auth')->middleware('personnelSoignant');
Route::post('/enrAnt', [medecinController::class,'enrAnt'])->name('enrAnt')->middleware('auth')->middleware('personnelSoignant');
Route::get('supAntecedent/{id}', [medecinController::class,'supAntecedent'])->name('supAntecedent')->middleware('auth')->middleware('personnelSoignant');
// terrain
Route::get('/terrain', [medecinController::class,'terrainPatient'])->name('terrain')->middleware('auth')->middleware('personnelSoignant');
Route::post('/enrTer', [medecinController::class,'enrTer'])->name('enrTer')->middleware('auth')->middleware('personnelSoignant');
Route::get('supTerrain/{id}', [medecinController::class,'supTerrain'])->name('supTerrain')->middleware('auth')->middleware('personnelSoignant');

Route::post('/consulter', [medecinController::class, 'consulter'])->name('consulter.med')->middleware('auth')->middleware('personnelSoignant');
Route::post('/consultercni', [medecinController::class, 'consultercni'])->name('consultercni.med')->middleware('auth')->middleware('personnelSoignant');
// Ajouter Secretaire
Route::get('ajoutSec/{id}', [secretaireController::class,'ajoutSec'])->middleware('auth')->middleware('personnelSoignant');
Route::get('elimSec/{id}', [secretaireController::class,'elimSec'])->middleware('auth')->middleware('personnelSoignant');
// Route Patient
Route::get('/profil', [PatientController::class, 'profil'])->name('profil')->middleware('auth')->middleware('patient');
Route::get('/Antece', [PatientController::class, 'Antece'])->name('Antece')->middleware('auth')->middleware('patient');
Route::get('/Terr', [PatientController::class, 'Terr'])->name('Terr')->middleware('auth')->middleware('patient');
Route::get('/rvforpatient', [PatientController::class, 'rvforpatient'])->name('rvforpatient')->middleware('auth')->middleware('patient');

Route::get('/dossierforpatient', [PatientController::class, 'dossierforpatient'])->name('dossierforpatient')->middleware('auth')->middleware('patient');
Route::get('voirConsforPatient/{id}', [PatientController::class,'voirConsforPatient'])->middleware('auth')->middleware('patient');

Route::get('/ordforpatient', [PatientController::class, 'ordforpatient'])->name('ordforpatient')->middleware('auth')->middleware('patient');
Route::get('voirOrdforPatient/{id}', [PatientController::class,'voirOrdforPatient'])->middleware('auth')->middleware('patient');

Route::get('/paraforpatient', [PatientController::class, 'paraforpatient'])->name('paraforpatient')->middleware('auth')->middleware('patient');
Route::get('voirparaforPatient/{id}', [PatientController::class,'voirparaforPatient'])->middleware('auth')->middleware('patient');

Route::get('/medreg', function () {
    return view('auth.register');
});

//Infirmier
Route::get('/accInf', [medecinController::class,'accInf'])->name('accInfirmier')->middleware('auth');
Route::get('/inf_cons', [medecinController::class,'inf_cons'])->name('inf_cons')->middleware('auth');

Route::post('/inf_consulter', [medecinController::class, 'inf_consulter'])->name('inf_consulter.med')->middleware('auth');
Route::post('/inf_consultercni', [medecinController::class, 'inf_consultercni'])->name('inf_consultercni.med')->middleware('auth');
//
// CAISSIER
Route::get('/ac_caissier', [caissierController::class,'ac_caisse'])->name('ac_caisse')->middleware('auth');
//Secretaire
Route::get('/accSec', [secretaireController::class, 'accSec'])->name('acc.sec')->middleware('auth');
Route::get('/insPatient', [secretaireController::class, 'insPatient'])->name('inscrir.Patients');
Route::post('/enregistrerPatient', [secretaireController::class, 'enregistrerPatient'])->name('enregistrer.Patients');
Route::get('/listForCons', [secretaireController::class, 'listForCons'])->name('listForCons');
Route::get('Queu/{id}', [secretaireController::class, 'Queu'])->name('Queu');
Route::post('/ajoutAuQueu', [SecretaireController::class,'ajoutAuQueu'])->name('ajoutAuQueu')->middleware('auth');
Route::get('/listMedSec', [secretaireController::class, 'listMedSec'])->name('listMedSec');
Route::get('voirqueu/{id}', [SecretaireController::class,'voirqueu'])->middleware('auth');
// sms
Route::get('alert/{id}', [secretaireController::class,'alertsms'])->middleware('auth');
Route::get('rpt/{id}', [secretaireController::class,'rpt'])->middleware('auth');
Route::get('/envAlert', [secretaireController::class,'envAlertsms'])->name('envAlert')->middleware('auth');
Route::post('/envRpt', [secretaireController::class,'envRptsms'])->name('envRpt')->middleware('auth');
Route::post('/persoAlertSms', [secretaireController::class,'persoAlertSms'])->name('persoAlertSms')->middleware('auth');
Route::post('/persoRptSms', [secretaireController::class,'persoRptSms'])->name('persoRptSms')->middleware('auth');

// Update
Route::post('/updatePatient', [medecinController::class,'updatePatient'])->name('updatePatient')->middleware('auth')->middleware('personnelSoignant');;
// change password
Route::post('/change-password', [medecinController::class, 'updatePassword'])->name('update-password')->middleware('auth');
// qr code consultation
// Abson

// Auth::routes();

// Route Patient


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
