<?php

namespace App\Http\Controllers;

use DateTime;
use Exception;
use Throwable;
use App\Models\RV;
use App\Models\User;
use App\Models\Patho;
use GuzzleHttp\Client;
use App\Models\Medecin;
use App\Models\Parabio;
use App\Models\Patient;
//use Illuminate\Foundation\Auth\User;
use App\Models\Terrain;
use App\Models\Bioteste;
use App\Models\cmedical;
use App\Models\Cvmedical;
use App\Models\PersoQueu;
use App\Models\Antecedent;
use App\Models\Ccvmedical;
use App\Models\Listpatien;
// use Twilio\Rest\Client;
//require '../../vendor/autoload.php';
use App\Models\Medicament;
use App\Models\Ordennance;
use App\Models\Secretaire;
use Infobip\Configuration;
use Infobip\Api\SendSmsApi;
use App\Models\Cmedicalplus;
use App\Models\Consultation;
use App\Models\Paraclinique;
use Illuminate\Http\Request;
use App\Models\Cmedicalrepos;
use Infobip\Model\SmsDestination;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use Infobip\Model\SmsTextualMessage;
use function PHPUnit\Framework\isEmpty;
use Illuminate\Validation\Rules\Exists;
use Infobip\Model\SmsAdvancedTextualRequest;



use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\JWT;



class medecinController extends Controller
{
    public function accMed()
    {

        if (Auth::user()->role == 'MEDECIN' || Auth::user()->role == 'MEDECINCHEF') {
            $med = Medecin::where('user_id', '=', Auth::user()->id)->firstOrFail();
            if(Auth::user()->role == 'MEDECINCHEF'){
                session(['stricture_id' => $med->stricture_id]);
            }
            $secretaires = Secretaire::where('stricture_id', '=', $med->stricture_id)->get();
            //dd($secretaires);
            $daterv =  date('d/m/Y');
            // le personnel
            $personelmed = Medecin::where('stricture_id', '=', $med->stricture_id)->get();
            return response()->json([
                "status" => 200,
                "secretaires" => $secretaires,
                "med" => $med,
                "personelmed" => $personelmed,

            ]);
            // return view('forMedecin.accueil', compact('rv', 'secretaires','med', 'daterv', 'nbrRV', 'nbrCON', 'k', 'liste', 'personelmed'));
        }
    }
    public function accMedAvecCalretour()
    {
        if(Auth::user()->role == 'MEDECIN' || Auth::user()->role == 'MEDECINCHEF'){
        $rv = RV::latest()->where('medecin_id', '=', Auth::user()->id)->join('users', 'users.id', '=', 'r_v_s.user_id')->where('daterv','=', $_COOKIE['rvDuJour'])->select('r_v_s.daterv', 'r_v_s.daterv', 'r_v_s.heurerv', 'r_v_s.note', 'r_v_s.user_id','users.prenom', 'users.nom', 'r_v_s.created_at' )->orderBy('r_v_s.created_at', 'desc')->get();
        $nbrRV =  $rv->count();
        $med = Medecin::where('user_id', '=', Auth::user()->id)->firstOrFail();
        $secretaires = Secretaire::where('stricture_id', '=', $med->stricture_id)->get();
        $daterv = date('d/m/Y',strtotime ($_COOKIE['rvDuJour']));
        $CON = Consultation::where('medecinuser_id', '=', Auth::user()->id)->where('datecons', '=', $_COOKIE['rvDuJour'])->get();
        $nbrCON = $CON->count();
        // Queu
        $q = DB::table('listpatiens')->where('medecin_id', '=', Auth::user()->id )->where('dateliste', '=', $_COOKIE['rvDuJour'])->get();
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
         $personelmed = Medecin::where('stricture_id', '=', $med->stricture_id)->get();
        return view('forMedecin.accueil', compact('rv', 'secretaires','med', 'daterv', 'nbrRV', 'nbrCON', 'k', 'liste', 'personelmed'));
        }elseif(Auth::user()->role == 'SECRETAIRE'){
            $secretaires = Secretaire::where('user_id', '=', Auth::user()->id)->firstOrFail();
            $medecins = DB::table('medecins')->where('id_secretaire1', '=',  $secretaires->id)->orwhere('id_secretaire2', '=',  $secretaires->id)->orwhere('id_secretaire3', '=',  $secretaires->id)->get();
           // dd($medecins);
                for( $i = 0; $i < $medecins->count(); $i++){
                    $med[$i] = DB::table('users')->where('id', '=', $medecins[$i]->user_id)->first();
                }
                $z = -1;
                $y = -1;
                for( $j = 0; $j < $medecins->count(); $j++){

                    $r = RV::where('medecin_id', '=', $med[$j]->id)->where('daterv','=', $_COOKIE['rvDuJour'])->join('users', 'users.id', '=', 'r_v_s.medecin_id')->get();
                    $r2 = DB::table('r_v_s')->where('medecin_id', '=', $med[$j]->id)->where('daterv','=',  $_COOKIE['rvDuJour'])->join('users', 'users.id', '=', 'r_v_s.user_id')->get();

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

                $daterv = date('d-m-Y',strtotime ($_COOKIE['rvDuJour']));
                return view('forSecretaire.accueil', compact('rv','rvs2','daterv'));
                }else{
                    $rv = collect($rvs);
                    $daterv = date('d-m-Y',strtotime ( $rvs[$z]->daterv));
                    return view('forSecretaire.accueil', compact('rv','rvs2','daterv'));
                }
        }
    }
    public function accMedAvecCal()
    {
        return redirect('/accMedAvecCalretour')->with('rvDuJour', 'les rv du jour select');
    }
    // liste patient
    public function history()
    {

        $patient = User::join('patients','patients.user_id', '=','users.id')->where('users.supprimer', '=', false)->select('users.id', 'users.prenom','users.nom', 'users.email', 'users.sexe', 'users.date_nai', 'users.statut','users.tel', 'users.adresse','patients.sang', 'patients.profession', 'patients.allergie', 'patients.CNI','patients.tel_a_prevenir' )->get();
        return view('forMedecin.listePatient', compact('patient'));
    }
    public function supUser($id){
        User::where('id', '=', $id)->update(['supprimer'=> true]);
        return redirect('/historique')->with("ok", "patient supprimer avec succes!");
    }
    public function consultation()
    {
        return view('forMedecin.consultation');
    }
    public function inscrir()
    {
        return view('forMedecin.inscrirPation');
    }
    public function inscrirPatient(Request $request)
    {
        $request->validate(['post',
            'nom' => ['required', 'string', 'max:50'],
            'prenom' => ['required', 'string', 'max:50'],
            'adresse' => ['required', 'string', 'max:50'],
            'date_nai'=> ['required', 'date', 'before:today'],
            'sexe' => ['required', 'string', 'max:255'],
            'email' => ['required','email', 'max:100', 'unique:users'],
            'tel' => ['required', 'numeric','digits:9', 'unique:users'],
            // 'tel_a_prevenir' => [ 'numeric', 'digits:9'],
            // 'CNI' => ['required','string', 'max:255','unique:patients' ],
            // 'password' => ['required', 'string', 'min:4'],
        ]);

        if($request->cartePatient){
           if(!is_numeric($request->cartePatient)){
                return back()->with("msg", "Il se peut que vous n'utilider pas une carte de Doctor's Help!");
           }
           if (Patient::where('cartePatient','=', $request->cartePatient)->count()>0) {
                return back()->with("msg", "carte deja occupee !");
           }
        }
        $user= User::create([
             'nom' => $request->nom,
             'prenom' => $request->prenom,
             'adresse' => $request->adresse,
             'date_nai' => $request->date_nai,
             'sexe' => $request->sexe,
             'statut' => $request->statut,
             'email' => $request->email,
             'tel' => $request->tel,
             'role' => $request->role,
             'password' => Hash::make($request->password),
         ]);
        Patient::create([
            'cartePatient' => $request->cartePatient,
            'profession' => $request->profession,
            'sang' => $request->sang,
            'allergie' => $request->allergie,
            'CNI' => $request->CNI,
            'medecin_id' => Auth::user()->id,
            'tel_a_prevenir' => $request->tel_a_prevenir,
            'user_id'=> $user->id
            ]);
              // send sms
                                $BASE_URL = "https://dm4me1.api.infobip.com";
                                $API_KEY = "cbb5e46dd28e62a771789d2917236f10-28445fa3-7849-4fca-9d1d-b1af47f2745f";

                                $SENDER = "DR'S HELP";
                                $RECIPIENT= '221'.$request->tel;
                                $MESSAGE_TEXT="Bonjour " . $request->prenom ." votre inscription sur la plateforme Doctor's help a reuissi !";

                                $configuration = (new Configuration())
                                    ->setHost($BASE_URL)
                                    ->setApiKeyPrefix('Authorization', 'App')
                                    ->setApiKey('Authorization', $API_KEY);

                                $client = new Client(['verify'=>false]);

                                $sendSmsApi = new SendSMSApi($client, $configuration);
                                $destination = (new SmsDestination())->setTo($RECIPIENT);
                                $message = (new SmsTextualMessage())
                                    ->setFrom($SENDER)
                                    ->setText($MESSAGE_TEXT)
                                    ->setDestinations([$destination]);

                                $request = (new SmsAdvancedTextualRequest())->setMessages([$message]);

                                try {
                                    $smsResponse = $sendSmsApi->sendSmsMessage($request);
                                    return view('forMedecin.consultation.rv', compact('rv', 'patient'))->with('Suc','Message envoyé avec succés');
                                    echo ("Response body: ".$smsResponse);
                                } catch (Throwable $apiException) {
                                    echo("HTTP Code: " . $apiException->getCode() . "\n");
                                }
            return back()->with("msg", "Patient enregistrer !");
    }

    // realiser une consultation
    public function consulter(Request $request){
        if($request->qrcode){
            if(!is_numeric($request->qrcode)){
                return redirect('/consultation')->with('non-trouve', " veuillez utiliser une carte de Doctor's help");
            }
        }
        $qrcode = $request->qrcode;
        $monPatient = Patient::where('cartePatient', '=', $qrcode)->first();
        if (!$monPatient) {
            return redirect('/consultation')->with('non-trouve', 'Patient non trouve');
        } else {
            $userpatient = User::where('id', '=', $monPatient->user_id)->first();
            session(['patient' => $userpatient->id]);
            return view('forMedecin.consultation.information', compact('userpatient', 'monPatient'));
        }
    }

    public function consultercni(Request $request){
        if($request->CNI){
            if(!is_numeric($request->CNI)){
                return redirect('/consultation')->with('non-trouve', 'CNI non valide');
            }
        }
        $CNI = $request->CNI;
         //$administrator = Administrator::find($varId);
        //$administrator = Administrator::where('login','=','admin')->first();
        $monPatient = Patient::where('CNI', '=', $CNI)->first();  //OrFail();// pour gerer les exceptionj
        if (!$monPatient) {
            return redirect('/consultation')->with('non-trouve', 'Patient non trouve');
        } else {
            $userpatient = User::where('id', '=', $monPatient->user_id)->first();

            session(['patient' => $userpatient->id]);


            return view('forMedecin.consultation.information', compact('userpatient', 'monPatient'));
        }
    }
    public function consul($id){
        //dd($id);
        session(['patient' => $id]);

        $userpatient = User::where('id', '=',$id )->first();
        $monPatient = Patient::where('user_id', '=',$id )->first();
        //dd($userpatient);
        return view('forMedecin.consultation.information', compact('userpatient', 'monPatient'));
    }
    public function consul2($id){
        //dd($id);
        session(['patient' => $id]);

        $userpatient = User::where('id', '=',$id )->first();
        $monPatient = Patient::where('user_id', '=',$id )->first();
        //dd($userpatient);
        return view('forMedecin.consultation.information', compact('userpatient', 'monPatient'));
    }
   public function infoPatient()
   {
        $monPatient = Patient::where('user_id', '=', session('patient'))->first();
        $userpatient = User::where('id', '=',session('patient'))->first();
       return view('forMedecin.consultation.information', compact('userpatient', 'monPatient'));
   }
   public  function attCarte(Request $request){

        if($request->cartePatient){
            if(!is_numeric($request->cartePatient)){
                return back()->with("invalide", "Il se peut que vous n'utilider pas une carte de Doctor's Help!");
            }
            //dd($request);
            // $request->validate(['post',
            //     'cartePatient' => ['unique:patients'],
            // ]);
            $p = Patient::where('cartePatient', '=', $request->cartePatient)->first();
            if ($p) {
                return redirect('/info')->with("ok", "Carte deja occupe!");
            } else {
                Patient::where('user_id', '=', session('patient'))->update(['cartePatient' => $request->cartePatient]);

                return redirect('/info')->with("ok", "Carte attribue avec succes!");
            }
        }
        return back()->with("invalide", "Il se peut que vous n'utilider pas une carte de Doctor's Help!");
    }
    public function enrAllergies(Request $request){
        $request->validate(['post',
            'allergie' => ['string'],
        ]);
            $p = Patient::where('user_id', '=', session('patient'))->first();
            $allergi = $p->allergie.'; '.$request->allergie ;
        Patient::where('user_id', '=', session('patient'))->update(['allergie' => $allergi]);
        return redirect('/info')->with("ok", "Carte attribue avec succes!");
   }
// Dossier Consultation patient=------------------------------------------------------------
   public function dossierPatient()
   {
        $consultations = Consultation::latest()->where('user_id', '=', session('patient'))->get();
        if ($consultations->count() > 0) {
            // dd($consultations);
            $consul = Consultation::latest()->where('user_id', '=', session('patient'))->firstOrFail();
            //dd($consul);
            session(['consultation_trouve' => true]);
            // dd(session('consultation_trouve'));
            return view('forMedecin.consultation.dossier', compact('consultations','consul'));
        }else{
            $consul = Consultation::latest()->where('user_id', '=', session('patient'))->get();
            session(['consultation_trouve' => false]);
            return view('forMedecin.consultation.dossier', compact('consultations','consul') );
        }
   }
   public function enrCon(Request $request){
        // $request->validate(['post',
        //     'motif' => ['string',],
        //     // 'temperature' => ['string'],
        //     // 'taille' => ['string'],
        //     // 'poids' => ['string'],
        //     // 'imc' => ['string'],
        //     // 'frequence' => [ 'string'],
        //     // 'pression' => ['string'],
        //     // 'glycemie' => [ 'string'],
        //     // 'saturation' => ['string'],

        //     // 'tdr' => ['string'],
        //     // 'autresParaclinique' => [ 'string'],
        //     // 'diagnostic' => [ 'string'],
        //     // 'o2r' => ['string'],
        //     // 'traitement' => ['string'],
        //     // 'besoinpf' => [ 'string'],
        //     // 'observation' => [ 'string'],
        //     // 'note' => ['string'],
        // ]);
        // dd('ok');
        $aujourd8 = time();
        $aujourdhui = date("Y-m-d");
        $patient = User::where('id', '=',session('patient'))->firstOrFail();
        $patient2 = Patient::where('user_id', '=',$patient->id)->firstOrFail();
        Consultation::create([
            // les constantes
            'motif' => $request->motif,
            'temperature' => $request->temperature,
            'taille' => $request->taille,
            'poids' => $request->poids,
            'imc' => $request->imc,
            'frequence' => $request->frequence,
            'pression' => $request->pression,
            'glycemie' => $request->glycemie,
            'saturation' => $request->saturation,
            // les exams
            'tdr' => $request->tdr,
            'autresParaclinique' => $request->autresParaclinique,
            'diagnostic' => $request->diagnostic,
            'o2r' => $request->o2r,
            'traitement' => $request->traitement,
            'besoinpf' => $request->besoinpf,
            'observation' => $request->observation,
            'note' => $request->note,
            'tdr' => $request->tdr,
            // Autre
            'datecons' => date('y/m/d'),
            'medecinuser_id'=> Auth::user()->id,
            'user_id'=> session('patient'),
            'numcons'=> 'CO'.$aujourd8,
            'prenom' =>$patient->prenom,
            'nom' =>$patient->nom,
            'sexe'=>$patient->sexe,
            'adresse'=>$patient->adresse,
            'profession'=>$patient2->profession,
            'age'=> date_diff(date_create($patient->date_nai), date_create($aujourdhui))->format('%y').' ans',
            'status'=>$patient->statut,
            'telephone'=>$patient->tel
        ]);
        return redirect('/dossier');
   }
   public function voirCons($id){
        // dd($id);
        $consultations = Consultation::latest()->where('user_id', '=', session('patient'))->get();
        $consul = Consultation::where('id', '=', $id)->firstOrFail();
        return view('forMedecin.consultation.dossier', compact('consultations','consul'));
   }

////////// Registre

public function registerPatient(){
    $consultations = Consultation::where('medecinuser_id', '=', Auth::user()->id)->orderBy('created_at', 'desc')->get();
    return view('forMedecin.register', compact('consultations'));
}
public function Book(){
    $consultations= Medecin::where('stricture_id', '=', session('stricture_id'))->join('users', 'users.id', '=', 'medecins.user_id')->join('consultations', 'consultations.medecinuser_id','users.id' )->
    select('users.nom','consultations.numcons', 'consultations.motif', 'consultations.temperature', 'consultations.taille',
     'consultations.poids', 'consultations.IMC', 'consultations.glycemie', 'consultations.saturation', 'consultations.autresParaclinique',
     'consultations.pression', 'consultations.frequence', 'consultations.tdr', 'consultations.diagnostic', 'consultations.besoinpf', 'consultations.o2r',
     'consultations.observation', 'consultations.note', 'consultations.prenom', 'consultations.adresse', 'consultations.sexe',
     'consultations.user_id', 'consultations.id',
     'consultations.age', 'consultations.telephone', 'consultations.created_at' )->orderBy('consultations.created_at', 'desc')->get();

    return view('forMedecin.book', compact('consultations'));
}
public function enrReg(Request $request){
    $request->validate(['post',
    'nom' => ['required', 'string', 'max:50'],
    'prenom' => ['required', 'string', 'max:50'],
    'adresse' => ['required', 'string', 'max:50'],
    'status'=> ['required', 'string', 'max:50'],
    'sexe' => ['required', 'string', 'max:255'],
    // 'email' => ['required','email', 'max:100', 'unique:users'],
    // 'tel' => ['required', 'numeric','digits:9', 'unique:users'],
    // 'tel_a_prevenir' => [ 'numeric', 'digits:9'],
    // 'CNI' => ['required','string', 'max:255','unique:patients' ],
    // 'password' => ['required', 'string', 'min:4'],
]);
    $aujourd8 = time();

     Consultation::create([
        // les constantes
        'motif' => $request->motif,
        'temperature' => $request->temperature,
        'taille' => $request->taille,
        'poids' => $request->poids,
        'imc' => $request->imc,
        'frequence' => $request->frequence,
        'pression' => $request->pression,
        'glycemie' => $request->glycemie,
        'saturation' => $request->saturation,
        // les exams
        'tdr' => $request->tdr,
        'autresParaclinique' => $request->autresParaclinique,
        'diagnostic' => $request->diagnostic,
        'o2r' => $request->o2r,
        //'traitement' => $request->traitement,
        'besoinpf' => $request->besoinpf,
        'observation' => $request->observation,
        'note' => $request->note,
        // Autre
        'datecons' => date('y/m/d'),
        'medecinuser_id'=> Auth::user()->id,
        //'user_id'=> 'nomEnregistrer',
        'numcons'=> 'CO'.$aujourd8,
        'prenom' =>$request->prenom,
        'nom' =>$request->nom,
        'sexe'=>$request->sexe,
        'adresse'=>$request->adresse,
        'profession'=>$request->profession,
        'age'=>$request->age,
        'status'=>$request->status,
        'telephone'=>$request->telephone
    ]);
    return redirect('/register');
}
// Detail cons
public function detailcon($id){
    session(['idcon' => $id]);
    $consultations = Consultation::where('id', '=', $id)->firstOrFail();
    return view('forMedecin.detail.detailconsInfo', compact('consultations'));
}
public function infoDetailPatient(){
    $consultations = Consultation::where('id', '=', session('idcon'))->firstOrFail();
    return view('forMedecin.detail.detailconsInfo', compact('consultations'));
}
public function consDetailPatient()
{
     $consul = Consultation::where('id', '=',session('idcon'))->firstOrFail();
     $consultations = Consultation::latest()->where('user_id', '=', $consul->user_id )->get();
         session(['consultation_trouve' => true]);
         return view('forMedecin.detail.dossier', compact('consultations','consul'));
}
public function voirConsDetail($id){
    $consult = Consultation::where('id', '=',session('idcon'))->firstOrFail();
    $consultations = Consultation::latest()->where('user_id', '=',$consult->user_id)->get();
    $consul = Consultation::where('id', '=', $id)->firstOrFail();
    return view('forMedecin.detail.dossier', compact('consultations','consul'));
}
public function ordDetailPatient()
   {
            $consultations = Consultation::where('id', '=',session('idcon'))->firstOrFail();
            // dd($consultations);
            $ordennances = Ordennance::latest()->where('consultation_id', '=', 'Consultation du '.$consultations->created_at)->get();
             //dd($ordennances);
            if($ordennances->count() > 0){
                $dernierOrd = Ordennance::latest()->where('consultation_id', '=', 'Consultation du '.$consultations->created_at)->firstOrFail();
                dd($dernierOrd);
                $ord_medicaments = Medicament::where('ordennance_id', '=', $dernierOrd->id )->get();
                $ord_med_date = Medicament::where('ordennance_id', '=', $dernierOrd->id )->firstOrFail();

                // $patient = User::where('id', '=', $consul->user_id)->firstOrFail();
                session(['ord_first' => true]);
                return view('forMedecin.detail.ordennance', compact('ordennances', 'ord_medicaments', 'ord_med_date','consultations'));
            }else{
                session(['ord_first' => false]);
                $consultations = Consultation::where( 'id', '=', session('idcon') )->firstOrFail();
                //dd($consultations);
                return view('forMedecin.detail.ordennance', compact('ordennances','consultations'));
            }
   }
   public function enrOrdDetail(Request $request){

    $request->validate(['post',
       'medicament1' => ['required', 'string'],
   //     'matin1' => ['numeric'],
   //     'midi1' => ['numeric'],
   //     'soire1' => ['numeric'],
   //     'quantite1' => [ 'string'],
   ]);
   // dd($request);
   $ord = Ordennance::create([
       'user_id'=> session('patient'),
       'medecinuser_id'=> Auth::user()->id,
       'consultation_id'=> $request->consultation
   ]);

   if ($request->medicament1) {
           $m = Medicament::create([
               'medicament'=>$request->medicament1,
               'matin'=>$request->matin1,
               'midi'=>$request->midi1,
               'soire'=>$request->soire1,
               'quantite'=>$request->quantite1,
               'ordennance_id'=> $ord->id,
           ]);
           if ($request->medicament2) {
               Medicament::create([
                   'medicament'=>$request->medicament2,
                   'matin'=>$request->matin2,
                   'midi'=>$request->midi2,
                   'soire'=>$request->soire2,
                   'quantite'=>$request->quantite2,
                   'ordennance_id'=> $ord->id,
               ]);
           }
           if ($request->medicament3) {
               Medicament::create([
                   'medicament'=>$request->medicament3,
                   'matin'=>$request->matin3,
                   'midi'=>$request->midi3,
                   'soire'=>$request->soire3,
                   'quantite'=>$request->quantite3,
                   'ordennance_id'=> $ord->id,
               ]);
           }
           if ($request->medicament4) {
               Medicament::create([
                   'medicament'=>$request->medicament4,
                   'matin'=>$request->matin4,
                   'midi'=>$request->midi4,
                   'soire'=>$request->soire4,
                   'quantite'=>$request->quantite4,
                   'ordennance_id'=> $ord->id,
               ]);
           }
           if ($request->medicament5) {
               Medicament::create([
                   'medicament'=>$request->medicament5,
                   'matin'=>$request->matin5,
                   'midi'=>$request->midi5,
                   'soire'=>$request->soire5,
                   'quantite'=>$request->quantite5,
                   'ordennance_id'=> $ord->id,
               ]);
           }
           if ($request->medicament6) {
               Medicament::create([
                   'medicament'=>$request->medicament6,
                   'matin'=>$request->matin6,
                   'midi'=>$request->midi6,
                   'soire'=>$request->soire6,
                   'quantite'=>$request->quantite6,
                   'ordennance_id'=> $ord->id,
               ]);
           }
           if ($request->medicament7) {
               Medicament::create([
                   'medicament'=>$request->medicament7,
                   'matin'=>$request->matin7,
                   'midi'=>$request->midi7,
                   'soire'=>$request->soire7,
                   'quantite'=>$request->quantite7,
                   'ordennance_id'=> $ord->id,
               ]);
           }
           if ($request->medicament8) {
               Medicament::create([
                   'medicament'=>$request->medicament8,
                   'matin'=>$request->matin8,
                   'midi'=>$request->midi8,
                   'soire'=>$request->soire8,
                   'quantite'=>$request->quantite8,
                   'ordennance_id'=> $ord->id,
               ]);
           }
           if ($request->medicament9) {
               Medicament::create([
                   'medicament'=>$request->medicament9,
                   'matin'=>$request->matin9,
                   'midi'=>$request->midi9,
                   'soire'=>$request->soire9,
                   'quantite'=>$request->quantite9,
                   'ordennance_id'=> $ord->id,
               ]);
           }
           if ($request->medicament10) {
               Medicament::create([
                   'medicament'=>$request->medicament10,
                   'matin'=>$request->matin10,
                   'midi'=>$request->midi10,
                   'soire'=>$request->soire10,
                   'quantite'=>$request->quantite10,
                   'ordennance_id'=> $ord->id,
               ]);
           }
       }

           session(['ord_first' => true]);
      return redirect('/ordDetail');
  }
   public function voirOrdDetail($id){
    $consultations = Consultation::where('id', '=', session('idcon'))->firstOrFail();
    $ordennances = Ordennance::latest()->where('consultation_id', '=', 'Consultation du '.$consultations->created_at)->get();
    $ord_medicaments = Medicament::where('ordennance_id', '=', $id )->get();
    $ord_med_date = Ordennance::where('id', '=', $id )->firstOrFail();
    //$patient = User::where('id', '=', $consultations->user_id )->firstOrFail();
    session(['ord_first' => true]);
return view('forMedecin.detail.ordennance', compact('ordennances', 'ord_medicaments','ord_med_date','consultations' ));
}
// Ordennance =------------------------------------------------------------------
   public function ordonnancePatient()
   {
            $ordennances = Ordennance::latest()->where('user_id', '=', session('patient'))->get();

            if($ordennances->count() > 0){
                $dernierOrd = Ordennance::latest()->where('user_id', '=', session('patient'))->firstOrFail();
                $ord_medicaments = Medicament::where('ordennance_id', '=', $dernierOrd->id )->get();
                $ord_med_date = Medicament::where('ordennance_id', '=', $dernierOrd->id )->firstOrFail();

                $consultations = Consultation::where('user_id', '=', session('patient'))->get();
                //dd($consultations);
                $patient = User::where('id', '=',  session('patient') )->firstOrFail();
                session(['ord_first' => true]);
                return view('forMedecin.consultation.ordennance', compact('ordennances', 'ord_medicaments', 'ord_med_date','consultations', 'patient'));
            }else{
                session(['ord_first' => false]);
                $consultations = Consultation::where('user_id', '=', session('patient'))->get();
                $patient = User::where('id', '=',  session('patient') )->firstOrFail();
                //dd($patient);
                return view('forMedecin.consultation.ordennance', compact('ordennances','consultations', "patient"));
            }
   }
   public function voirOrd($id){
        $ordennances = Ordennance::latest()->where('user_id', '=', session('patient'))->get();
        $ord_medicaments = Medicament::where('ordennance_id', '=', $id )->get();
        $ord_med_date = Ordennance::where('id', '=', $id )->firstOrFail();
        $consultations = Consultation::where('user_id', '=', session('patient'))->get();
        $patient = User::where('id', '=',  session('patient') )->firstOrFail();
        session(['ord_first' => true]);
    return view('forMedecin.consultation.ordennance', compact('ordennances', 'ord_medicaments','ord_med_date','consultations', 'patient' ));
   }

   public function enrOrd(Request $request){

     $request->validate(['post',
        'medicament1' => ['required', 'string'],
    //     'matin1' => ['numeric'],
    //     'midi1' => ['numeric'],
    //     'soire1' => ['numeric'],
    //     'quantite1' => [ 'string'],
    ]);
    // dd($request);
    $ord = Ordennance::create([
        'user_id'=> session('patient'),
        'medecinuser_id'=> Auth::user()->id,
        'consultation_id'=> $request->consultation
    ]);

    if ($request->medicament1) {
            $m = Medicament::create([
                'medicament'=>$request->medicament1,
                'matin'=>$request->matin1,
                'midi'=>$request->midi1,
                'soire'=>$request->soire1,
                'quantite'=>$request->quantite1,
                'ordennance_id'=> $ord->id,
            ]);
            if ($request->medicament2) {
                Medicament::create([
                    'medicament'=>$request->medicament2,
                    'matin'=>$request->matin2,
                    'midi'=>$request->midi2,
                    'soire'=>$request->soire2,
                    'quantite'=>$request->quantite2,
                    'ordennance_id'=> $ord->id,
                ]);
            }
            if ($request->medicament3) {
                Medicament::create([
                    'medicament'=>$request->medicament3,
                    'matin'=>$request->matin3,
                    'midi'=>$request->midi3,
                    'soire'=>$request->soire3,
                    'quantite'=>$request->quantite3,
                    'ordennance_id'=> $ord->id,
                ]);
            }
            if ($request->medicament4) {
                Medicament::create([
                    'medicament'=>$request->medicament4,
                    'matin'=>$request->matin4,
                    'midi'=>$request->midi4,
                    'soire'=>$request->soire4,
                    'quantite'=>$request->quantite4,
                    'ordennance_id'=> $ord->id,
                ]);
            }
            if ($request->medicament5) {
                Medicament::create([
                    'medicament'=>$request->medicament5,
                    'matin'=>$request->matin5,
                    'midi'=>$request->midi5,
                    'soire'=>$request->soire5,
                    'quantite'=>$request->quantite5,
                    'ordennance_id'=> $ord->id,
                ]);
            }
            if ($request->medicament6) {
                Medicament::create([
                    'medicament'=>$request->medicament6,
                    'matin'=>$request->matin6,
                    'midi'=>$request->midi6,
                    'soire'=>$request->soire6,
                    'quantite'=>$request->quantite6,
                    'ordennance_id'=> $ord->id,
                ]);
            }
            if ($request->medicament7) {
                Medicament::create([
                    'medicament'=>$request->medicament7,
                    'matin'=>$request->matin7,
                    'midi'=>$request->midi7,
                    'soire'=>$request->soire7,
                    'quantite'=>$request->quantite7,
                    'ordennance_id'=> $ord->id,
                ]);
            }
            if ($request->medicament8) {
                Medicament::create([
                    'medicament'=>$request->medicament8,
                    'matin'=>$request->matin8,
                    'midi'=>$request->midi8,
                    'soire'=>$request->soire8,
                    'quantite'=>$request->quantite8,
                    'ordennance_id'=> $ord->id,
                ]);
            }
            if ($request->medicament9) {
                Medicament::create([
                    'medicament'=>$request->medicament9,
                    'matin'=>$request->matin9,
                    'midi'=>$request->midi9,
                    'soire'=>$request->soire9,
                    'quantite'=>$request->quantite9,
                    'ordennance_id'=> $ord->id,
                ]);
            }
            if ($request->medicament10) {
                Medicament::create([
                    'medicament'=>$request->medicament10,
                    'matin'=>$request->matin10,
                    'midi'=>$request->midi10,
                    'soire'=>$request->soire10,
                    'quantite'=>$request->quantite10,
                    'ordennance_id'=> $ord->id,
                ]);
            }
        }

            session(['ord_first' => true]);
       return redirect('/ordonnance');
   }

// paraclinique

public function paracliniquePatient()
{
         $paracliniques = Paraclinique::latest()->where('user_id', '=', session('patient'))->get();
         if($paracliniques->count() > 0){
             $paraclinique = Paraclinique::latest()->where('user_id', '=', session('patient'))->firstOrFail();
             $patient = User::where('id', '=',  session('patient') )->firstOrFail();
             $consultations = Consultation::where('user_id', '=', session('patient'))->get();
             //dd($consultations);
             session(['para_first' => true]);
             return view('forMedecin.consultation.paraclinique', compact('paracliniques','paraclinique', 'patient', 'consultations'));
         }else{
             session(['para_first' => false]);
             $consultations = Consultation::where('user_id', '=', session('patient'))->get();
             return view('forMedecin.consultation.paraclinique', compact('paracliniques','consultations'));
         }
}

public function voirparaclinique($id){
     $paracliniques = Paraclinique::latest()->where('user_id', '=', session('patient'))->get();
     $paraclinique = Paraclinique::where('id', '=', $id )->firstOrFail();
     //dd( $paraclinique);
     $patient = User::where('id', '=',  session('patient') )->firstOrFail();
     $consultations = Consultation::where('user_id', '=', session('patient'))->get();

     session(['para_first' => true]);
 return view('forMedecin.consultation.paraclinique', compact('paracliniques', 'paraclinique','consultations', 'patient' ));
}
public function enrparaclinique(Request $request){
    $request->validate(['post',
        'exam' => ['required', 'string'],
        'diagnostic' => ['string'],
        'consultation_id' => ['string', 'required'],
    ]);
    Paraclinique::create([
        'exam'=> $request->exam,
        'diagnostic'=> $request->diagnostic,
        'user_id'=> session('patient'),
        'medecinuser_id'=>Auth::user()->id,
        'consultation_id' =>$request->consultation_id
    ]);

        // $paracliniques = Paraclinique::latest()->where('user_id', '=', session('patient'))->get();

        // $paraclinique = Paraclinique::latest()->where('user_id', '=', session('patient'))->firstOrFail();
        // $patient = User::where('id', '=',  session('patient') )->firstOrFail();
        // $consultations = Consultation::where('user_id', '=', session('patient'))->get();
        session(['para_first' => true]);
        //return view('forMedecin.consultation.paraclinique', compact('paracliniques','paraclinique', 'patient', 'consultations'));
        return redirect('/paraclinique');
}

// para Bio

public function paraBioPatient()
{
         $paracliniques = Parabio::latest()->where('user_id', '=', session('patient'))->get();
         if($paracliniques->count() > 0){
             $paraclinique = Parabio::latest()->where('user_id', '=', session('patient'))->firstOrFail();
             $paracliniquedetails = Bioteste::latest()->where('parabio_id', '=', $paraclinique->id)->get();
             $patient = User::where('id', '=',  session('patient') )->firstOrFail();
             $consultations = Consultation::where('user_id', '=', session('patient'))->get();
            // dd($consultations);
             session(['paraBio_first' => true]);
             return view('forMedecin.consultation.paraBio', compact('paracliniques','paracliniquedetails','paraclinique', 'patient', 'consultations'));
         }else{
             session(['paraBio_first' => false]);
             $consultations = Consultation::where('user_id', '=', session('patient'))->get();
             return view('forMedecin.consultation.paraBio', compact('paracliniques','consultations'));
         }
}
public function voirparaBio($id){
    $paracliniques = Parabio::latest()->where('user_id', '=', session('patient'))->get();
    $paraclinique = Parabio::latest()->where('user_id', '=', session('patient'))->firstOrFail();
    $paracliniquedetails = Bioteste::latest()->where('parabio_id', '=', $id)->get();
    $patient = User::where('id', '=',  session('patient') )->firstOrFail();
    $consultations = Consultation::where('user_id', '=', session('patient'))->get();
    //dd($consultations);
    session(['paraBio_first' => true]);
    return view('forMedecin.consultation.paraBio', compact('paracliniques','paracliniquedetails','paraclinique', 'patient', 'consultations'));
}

public function enrparaBio(Request $request){

    $request->validate(['post',
        'teste1' => ['required', 'string'],
        'consultation' => ['required'],
    ]);
    //dd( $request->consultation);
   $parabio =  Parabio::create([
        'user_id'=> session('patient'),
        'medecinuser_id'=> Auth::user()->id,
        'consultation_id'=> $request->consultation
   ]);
    Bioteste::create([
        'teste'=> $request->teste1,
        'parabio_id'=> $parabio->id,
    ]);
    if($request->teste2){
        Bioteste::create([
            'teste'=> $request->teste2,
            'parabio_id'=> $parabio->id,
        ]);
        if($request->teste3){
            Bioteste::create([
                'teste'=> $request->teste3,
                'parabio_id'=> $parabio->id,
            ]);
            if($request->teste4){
                Bioteste::create([
                    'teste'=> $request->teste4,
                    'parabio_id'=> $parabio->id,
                ]);
                if($request->teste5){
                    Bioteste::create([
                        'teste'=> $request->teste5,
                        'parabio_id'=> $parabio->id,
                    ]);
                    if($request->teste6){
                        Bioteste::create([
                            'teste'=> $request->teste6,
                            'parabio_id'=> $parabio->id,
                        ]);
                        if($request->teste7){
                            Bioteste::create([
                                'teste'=> $request->teste7,
                                'parabio_id'=> $parabio->id,
                            ]);
                            if($request->teste8){
                                Bioteste::create([
                                    'teste'=> $request->teste8,
                                    'parabio_id'=> $parabio->id,
                                ]);
                                if($request->teste9){
                                    Bioteste::create([
                                        'teste'=> $request->teste9,
                                        'parabio_id'=> $parabio->id,
                                    ]);
                                    if($request->teste10){
                                        Bioteste::create([
                                            'teste'=> $request->teste10,
                                            'parabio_id'=> $parabio->id,
                                        ]);

                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
        // $paracliniques = Paraclinique::latest()->where('user_id', '=', session('patient'))->get();

        // $paraclinique = Paraclinique::latest()->where('user_id', '=', session('patient'))->firstOrFail();
        // $patient = User::where('id', '=',  session('patient') )->firstOrFail();
        // $consultations = Consultation::where('user_id', '=', session('patient'))->get();
        session(['paraBio_first' => true]);
        //return view('forMedecin.consultation.paraclinique', compact('paracliniques','paraclinique', 'patient', 'consultations'));
        return redirect('/paraBio');
}
//Certificat medical
public function cMPatient(){
    $cmedicales = cmedical::latest()->where('user_id', '=', session('patient'))->get();
    if($cmedicales->count() > 0){
        $cmdcal = cmedical::latest()->where('user_id', '=', session('patient'))->firstOrFail();
        $patient = User::where('id', '=',  session('patient') )->firstOrFail();
        $consultations = Consultation::where('user_id', '=', session('patient'))->get();
        //dd($consultations);
        session(['cmdcal_first' => true]);
        return view('forMedecin.consultation.certificat.certificatMedical', compact('cmedicales','cmdcal', 'patient', 'consultations'));
    }else{
        session(['cmdcal_first' => false]);
        $consultations = Consultation::where('user_id', '=', session('patient'))->get();
        return view('forMedecin.consultation.certificat.certificatMedical', compact('cmedicales','consultations'));
    }

}
public function voircM($id){
    $cmedicales = cmedical::latest()->where('user_id', '=', session('patient'))->get();
    $cmdcal = cmedical::where('id', '=', $id )->firstOrFail();
    $patient = User::where('id', '=',  session('patient') )->firstOrFail();
    $consultations = Consultation::where('user_id', '=', session('patient'))->get();
    session(['cmdcal_first' => true]);
return view('forMedecin.consultation.certificat.certificatMedical', compact('cmedicales', 'cmdcal','consultations', 'patient' ));
}
public function enrcM(Request $request){
    $request->validate(['post',
        'pathologie' => ['required', 'string'],
        'lieu_nai' => ['required', 'string'],
        'consultation_id' => ['string', 'required'],
    ]);
    cmedical::create([
        'pathologie'=> $request->pathologie,
        'lieu_nai'=> $request->lieu_nai,
        'user_id'=> session('patient'),
        'datecmedical'=> date('Y-m-d'),
        'medecinuser_id'=>Auth::user()->id,
        'consultation_id' =>$request->consultation_id
    ]);
        session(['cmdcal_first' => true]);
        return redirect('/cM');
}
//Certificat de visite medical
public function cvmedicalPatient(){
    $cmedicales = Cvmedical::latest()->where('user_id', '=', session('patient'))->get();
    if($cmedicales->count() > 0){
        $cmdcal = Cvmedical::latest()->where('user_id', '=', session('patient'))->firstOrFail();
        $patient = User::where('id', '=',  session('patient') )->firstOrFail();
        $consultations = Consultation::where('user_id', '=', session('patient'))->get();
        //dd($consultations);
        session(['cvmdcal_first' => true]);
        return view('forMedecin.consultation.certificat.certificatvisitemedical', compact('cmedicales','cmdcal', 'patient', 'consultations'));
    }else{
        session(['cvmdcal_first' => false]);
        $consultations = Consultation::where('user_id', '=', session('patient'))->get();
        return view('forMedecin.consultation.certificat.certificatvisitemedical', compact('cmedicales','consultations'));
    }

}
public function voircvmedical($id){
    $cmedicales = Cvmedical::latest()->where('user_id', '=', session('patient'))->get();
    $cmdcal = Cvmedical::where('id', '=', $id )->firstOrFail();
    $patient = User::where('id', '=',  session('patient') )->firstOrFail();
    $consultations = Consultation::where('user_id', '=', session('patient'))->get();
    session(['cvmdcal_first' => true]);
return view('forMedecin.consultation.certificat.certificatvisitemedical', compact('cmedicales', 'cmdcal','consultations', 'patient' ));
}
public function enrcvmedical(Request $request){
    $request->validate(['post',
        'consultation_id' => ['string', 'required'],
        'lieu_nai' => ['required', 'string'],
    ]);
    Cvmedical::create([
        'user_id'=> session('patient'),
        'datecvmedical'=> date('Y-m-d'),
        'medecinuser_id'=>Auth::user()->id,
        'lieu_nai'=> $request->lieu_nai,
        'consultation_id' =>$request->consultation_id
    ]);
        session(['cvmdcal_first' => true]);
        return redirect('/cvmedical');
}
//Certificat de visite contre medical
public function ccvmedicalPatient(){
    $cmedicales = Ccvmedical::latest()->where('user_id', '=', session('patient'))->get();
    if($cmedicales->count() > 0){
        $cmdcal = Ccvmedical::latest()->where('user_id', '=', session('patient'))->firstOrFail();
        $patient = User::where('id', '=',  session('patient') )->firstOrFail();
        $consultations = Consultation::where('user_id', '=', session('patient'))->get();
        //dd($consultations);
        session(['ccvmdcal_first' => true]);
        return view('forMedecin.consultation.certificat.certificatContrevisite', compact('cmedicales','cmdcal', 'patient', 'consultations'));
    }else{
        session(['ccvmdcal_first' => false]);
        $consultations = Consultation::where('user_id', '=', session('patient'))->get();
        return view('forMedecin.consultation.certificat.certificatContrevisite', compact('cmedicales','consultations'));
    }

}
public function voirccvmedical($id){
    $cmedicales = Ccvmedical::latest()->where('user_id', '=', session('patient'))->get();
    $cmdcal = Ccvmedical::where('id', '=', $id )->firstOrFail();
    $patient = User::where('id', '=',  session('patient') )->firstOrFail();
    $consultations = Consultation::where('user_id', '=', session('patient'))->get();
    session(['ccvmdcal_first' => true]);
return view('forMedecin.consultation.certificat.certificatContrevisite', compact('cmedicales', 'cmdcal','consultations', 'patient' ));
}
public function enrccvmedical(Request $request){
    $request->validate(['post',
        'consultation_id' => ['string', 'required'],
        'lieu_nai' => ['required', 'string'],
    ]);
    Ccvmedical::create([
        'user_id'=> session('patient'),
        'datecvmedical'=> date('Y-m-d'),
        'medecinuser_id'=>Auth::user()->id,
        'lieu_nai'=> $request->lieu_nai,
        'consultation_id' =>$request->consultation_id
    ]);
        session(['ccvmdcal_first' => true]);
        return redirect('/ccvmedical');
}
//Certificat medical plus
public function cMplusPatient(){
    $cmedicales = Cmedicalplus::latest()->where('user_id', '=', session('patient'))->get();
    if($cmedicales->count() > 0){
        $cmdcal = Cmedicalplus::latest()->where('user_id', '=', session('patient'))->firstOrFail();
        $patient = User::where('id', '=',  session('patient') )->firstOrFail();
        $consultations = Consultation::where('user_id', '=', session('patient'))->get();
        //dd($consultations);
        session(['cmdcalplus_first' => true]);
        return view('forMedecin.consultation.certificat.certificatmedicalplus', compact('cmedicales','cmdcal', 'patient', 'consultations'));
    }else{
        session(['cmdcalplus_first' => false]);
        $consultations = Consultation::where('user_id', '=', session('patient'))->get();
        return view('forMedecin.consultation.certificat.certificatmedicalplus', compact('cmedicales','consultations'));
    }

}
public function voircMplus($id){
    $cmedicales = Cmedicalplus::latest()->where('user_id', '=', session('patient'))->get();
    $cmdcal = Cmedicalplus::where('id', '=', $id )->firstOrFail();
    $patient = User::where('id', '=',  session('patient') )->firstOrFail();
    $consultations = Consultation::where('user_id', '=', session('patient'))->get();
    session(['cmdcalplus_first' => true]);
return view('forMedecin.consultation.certificat.certificatmedicalplus', compact('cmedicales', 'cmdcal','consultations', 'patient' ));
}
public function enrcMplus(Request $request){
    $request->validate(['post',
        'diagnostic' => ['required', 'string'],
        'dateaccident' => ['required', 'string'],
        'lieu_nai' => ['required', 'string'],
        'consultation_id' => ['string', 'required'],
    ]);
    //dd($request);
    Cmedicalplus::create([
        'diagnostic'=> $request->diagnostic,
        'incapacite'=> $request->incapacite,
        'dateaccident'=> $request->dateaccident,
        'user_id'=> session('patient'),
        'datecmedical'=> date('Y-m-d'),
        'medecinuser_id'=>Auth::user()->id,
        'lieu_nai'=> $request->lieu_nai,
        'consultation_id' =>$request->consultation_id
    ]);
        session(['cmdcalplus_first' => true]);
        return redirect('/cMplus');
}
//Certificat medical de repos
public function cMreposPatient(){
    $cmedicales = Cmedicalrepos::latest()->where('user_id', '=', session('patient'))->get();
    if($cmedicales->count() > 0){
        $cmdcal = Cmedicalrepos::latest()->where('user_id', '=', session('patient'))->firstOrFail();
        $patient = User::where('id', '=',  session('patient') )->firstOrFail();
        $consultations = Consultation::where('user_id', '=', session('patient'))->get();
        //dd($consultations);
        session(['cmdcalrepos_first' => true]);
        return view('forMedecin.consultation.certificat.certificatrepos', compact('cmedicales','cmdcal', 'patient', 'consultations'));
    }else{
        session(['cmdcalrepos_first' => false]);
        $consultations = Consultation::where('user_id', '=', session('patient'))->get();
        return view('forMedecin.consultation.certificat.certificatrepos', compact('cmedicales','consultations'));
    }

}
public function voircMrepos($id){
    $cmedicales = Cmedicalrepos::latest()->where('user_id', '=', session('patient'))->get();
    $cmdcal = Cmedicalrepos::where('id', '=', $id )->firstOrFail();
    $patient = User::where('id', '=',  session('patient') )->firstOrFail();
    $consultations = Consultation::where('user_id', '=', session('patient'))->get();
    session(['cmdcalrepos_first' => true]);
return view('forMedecin.consultation.certificat.certificatrepos', compact('cmedicales', 'cmdcal','consultations', 'patient' ));
}
public function enrcMrepos(Request $request){
    $request->validate(['post',
        'pathologie' => ['required', 'string'],
        'consultation_id' => ['string', 'required'],
    ]);
    //dd($request);
    Cmedicalrepos::create([
        'incapacite'=> $request->incapacite,
        'pathologie'=> $request->pathologie,
        'user_id'=> session('patient'),
        'datecrmedical'=> date('Y-m-d'),
        'medecinuser_id'=>Auth::user()->id,
        'consultation_id' =>$request->consultation_id
    ]);
        session(['cmdcalrepos_first' => true]);
        return redirect('/cMrepos');
}
// les rv =---------------------------------------------------------------------------------
   public function rvPatient()
   {
       $rv = RV::latest()->where('user_id', '=', session('patient'))->get();

       $patient = User::where('id', '=',session('patient') )->firstOrFail();
       return view('forMedecin.consultation.rv', compact('rv', 'patient'));
   }
    public function enrRv(Request $request)
    {
        $request->validate(['post',
            'daterv' => ['required', 'date',],
            'heurerv' => ['required'],
            'note'=> ['string'],
        ]);
       // $rv_encours = RV::latest()->where('user_id', '=', session('patient'))->get();
       $rv_encours = DB::table('r_v_s')->latest()->where('user_id', '=', session('patient'))->first();
       if ($rv_encours) {
                $aujourd8 = time();
                $debut =new DateTime(date('y-m-d h:i:s', $aujourd8));
                $fin = new DateTime($rv_encours->daterv);
                $interval = $debut->diff($fin);
                $jour = -1;
                //dd($interval->format('%R%D'));
            if ($interval->format('%R%D') > $jour) {
                return redirect('/rv')->with("msg", "Le patient a deja un rendez-vous encours !");
            }
        }
        $rvexiste = RV::where('daterv', '=', $request->daterv)->where('heurerv', '=', $request->heurerv)->get();
        if ($rvexiste->count()>0) {
            return back()->with("msg", "date et heure deja occupees !");
       }
       //dd($rvexiste);
        RV::create([
        'daterv' => $request->daterv,
        'heurerv' => $request->heurerv,
        'note' => $request->note,
        'user_id'=> session('patient'),
        'medecin_id'=> Auth::user()->id,
        ]);
        $rv = RV::latest()->where('user_id', '=', session('patient'))->get();
        $patient = User::where('id', '=',session('patient') )->firstOrFail();

        // send sms
                                $BASE_URL = "https://dm4me1.api.infobip.com";
                                $API_KEY = "cbb5e46dd28e62a771789d2917236f10-28445fa3-7849-4fca-9d1d-b1af47f2745f";

                                $SENDER = "DR'S HELP";
                                $RECIPIENT=$request->tellephone;
                                $MESSAGE_TEXT= "Bonjour " . $patient->prenom ." votre rendez-vous avec Dr " . Auth::user()->nom ." a été fixé pour le " . $request->daterv . " à " . $request->heurerv ."\nDoctor's Help vous souhaite un bon retablissement!" ;

                                $configuration = (new Configuration())
                                    ->setHost($BASE_URL)
                                    ->setApiKeyPrefix('Authorization', 'App')
                                    ->setApiKey('Authorization', $API_KEY);

                                $client = new Client(['verify'=>false]);

                                $sendSmsApi = new SendSMSApi($client, $configuration);
                                $destination = (new SmsDestination())->setTo($RECIPIENT);
                                $message = (new SmsTextualMessage())
                                    ->setFrom($SENDER)
                                    ->setText($MESSAGE_TEXT)
                                    ->setDestinations([$destination]);

                                $request = (new SmsAdvancedTextualRequest())->setMessages([$message]);

                                try {
                                    $smsResponse = $sendSmsApi->sendSmsMessage($request);
                                    return view('forMedecin.consultation.rv', compact('rv', 'patient'))->with('Suc','Message envoyé avec succés');
                                    echo ("Response body: ".$smsResponse);
                                } catch (Throwable $apiException) {
                                    //echo("HTTP Code: " . $apiException->getCode() . "\n");
                                }
        return view('forMedecin.consultation.rv', compact('rv', 'patient'))->with('msg','Message envoyé avec succés');
    }
    public function rptRv(Request $rqt)
    {
        $rqt->validate(['post',
            'daterv' => ['required', 'date',],
                                                // 'after:today'
            'heurerv' => ['required'],
            'note'=> ['string'],
        ]);

        $rvexiste = RV::where('medecin_id', '=',Auth::user()->id )->where('daterv', '=', $rqt->daterv)->where('heurerv', '=', $rqt->heurerv)->get();
        if ($rvexiste->count()>0) {
            return back()->with("msg", "date et heure deja occupees !");
       }
       $rv_encours = DB::table('r_v_s')->latest()->where('user_id', '=', session('patient'))->first();
       $ancein = RV::where('id', '=', $rv_encours->id)->first();
       $patient = User::where('id', '=',session('patient') )->firstOrFail();
        // // send sms
                                $BASE_URL = "https://dm4me1.api.infobip.com";
                                $API_KEY = "cbb5e46dd28e62a771789d2917236f10-28445fa3-7849-4fca-9d1d-b1af47f2745f";

                                $SENDER = "DR'S HELP";
                                $RECIPIENT=$rqt->telephone;
                                $MESSAGE_TEXT= "Bonjour " . $patient->prenom ." votre rendez-vous  du " . $ancein->daterv . " à " . $ancein->heurerv ." est repporte jusqu'au " . $rqt->daterv . " à " . $rqt->heurerv ;

                                $configuration = (new Configuration())
                                    ->setHost($BASE_URL)
                                    ->setApiKeyPrefix('Authorization', 'App')
                                    ->setApiKey('Authorization', $API_KEY);

                                $client = new Client(['verify'=>false]);

                                $sendSmsApi = new SendSMSApi($client, $configuration);
                                $destination = (new SmsDestination())->setTo($RECIPIENT);
                                $message = (new SmsTextualMessage())
                                    ->setFrom($SENDER)
                                    ->setText($MESSAGE_TEXT)
                                    ->setDestinations([$destination]);

                                $request = (new SmsAdvancedTextualRequest())->setMessages([$message]);

                                try {
                                    $smsResponse = $sendSmsApi->sendSmsMessage($request);
                                    //return view('forMedecin.consultation.rv', compact('rv', 'patient'))->with('Suc','Message envoyé avec succés');
                                    echo ("Response body: ".$smsResponse);
                                } catch (Throwable $apiException) {
                                    echo("HTTP Code: " . $apiException->getCode() . "\n");
                                }
        $rv_encours = DB::table('r_v_s')->latest()->where('user_id', '=', session('patient'))->first();
        RV::where('id', '=', $rv_encours->id)->update(['daterv' => $rqt->daterv,'heurerv' => $rqt->heurerv, 'note' => $rqt->note,]);
            $rve = RV::where('date');
            $rv = RV::latest()->where('user_id', '=', session('patient'))->get();

        return view('forMedecin.consultation.rv', compact('rv', 'patient'))->with('Suc','Message envoyé avec succés');
    }

    public function supRv($id){
        // dd('sup');
        $rv = RV::where('id', '=', $id)->firstOrFail();
        $patient = User::where('id', '=', $rv->user_id )->firstOrFail();
        $m = Medecin::where('id', '=', $rv->medecin_id )->firstOrFail();
        $nedecin = User::Where('id', '=', $m->user_id )->firstOrFail();
        RV::where('id', '=', $id)->delete();
       if(!$patient->tel){
            if(Auth::user()->role == 'Medecin' || Auth::user()->role == 'MEDECINCHEF'){
                return redirect('/rv')->with("suc", "Le RV n'a pas ete supprimer !");
            }elseif(Auth::user()->role == 'SECRETAIRE'){
                return redirect('/accSec')->with("suc", "Le RV n'a pas ete supprimer !");
            }
       }
         // send sms
                                $BASE_URL = "https://dm4me1.api.infobip.com";
                                $API_KEY = "cbb5e46dd28e62a771789d2917236f10-28445fa3-7849-4fca-9d1d-b1af47f2745f";

                                $SENDER = "DR'S HELP";
                                $RECIPIENT='221' . $patient->tel;
                                $MESSAGE_TEXT= "Bonjour " . $patient->prenom ." votre rendez-vous avec Dr " . $nedecin->nom ." a annule \nVeillez vous rapprocher de votre pour plus plus d'eclairecissement" ;

                                $configuration = (new Configuration())
                                    ->setHost($BASE_URL)
                                    ->setApiKeyPrefix('Authorization', 'App')
                                    ->setApiKey('Authorization', $API_KEY);

                                $client = new Client(['verify'=>false]);

                                $sendSmsApi = new SendSMSApi($client, $configuration);
                                $destination = (new SmsDestination())->setTo($RECIPIENT);
                                $message = (new SmsTextualMessage())
                                    ->setFrom($SENDER)
                                    ->setText($MESSAGE_TEXT)
                                    ->setDestinations([$destination]);

                                $request = (new SmsAdvancedTextualRequest())->setMessages([$message]);

                                try {
                                    $smsResponse = $sendSmsApi->sendSmsMessage($request);
                                    //return view('forMedecin.consultation.rv', compact('rv', 'patient'))->with('Suc','Message envoyé avec succés');
                                    echo ("Response body: ".$smsResponse);
                                } catch (Throwable $apiException) {
                                    echo("HTTP Code: " . $apiException->getCode() . "\n");
                                }

        if(Auth::user()->role == 'Medecin' || Auth::user()->role == 'MEDECINCHEF'){
            return redirect('/rv')->with("suc", "Le RV a ete supprimer !");
        }elseif(Auth::user()->role == 'SECRETAIRE'){
            return redirect('/accSec')->with("suc", "Le RV a ete supprimer !");
        }
    }
// les antecedent =--------------------------------------------------------------
   public function antecedentPatient()
   {
       $antecedents = Antecedent::latest()->where('user_id', '=', session('patient'))->where('supprimer', '=', false)->get();
       return view('forMedecin.consultation.antecedent', compact('antecedents'));
   }
   public function enrAnt(Request $request)
   {
       $request->validate(['post',
       'pathologie' => ['required', 'string'],
       'type' => ['required', 'string'],
       ]);
       Antecedent::create([
           'pathologie' => $request->pathologie,
           'type' => $request->type,
           'note' => $request->note,
           'user_id'=> session('patient')
       ]);
       $antecedents = Antecedent::where('user_id', '=', session('patient'))->where('supprimer', '=', false)->get();
       return view('forMedecin.consultation.antecedent', compact('antecedents'));
   }
   public function supAntecedent($id){
        Antecedent::where('id', '=', $id)->update(['supprimer'=> true]);
        return redirect('/antecedent')->with("ok", "Carte attribue avec succes!");
   }
// les terrain =------------------------------------------------------------------
   public function terrainPatient()
   {
       $terrains = Terrain::latest()->where('user_id', '=', session('patient'))->where('supprimer', '=', false)->get();
       return view('forMedecin.consultation.terrain', compact('terrains'));
   }
   public function enrTer( Request $request){
    $request->validate(['post',
    'pathologie' => ['required', 'string'],
    'famille' => ['required', 'string'],
    'datedebut' => ['required', 'date'],

    ]);
    Terrain::create([
        'pathologie' => $request->pathologie,
        'famille' => $request->famille,
        'datedebut' => $request->datedebut,
        'user_id'=> session('patient')
    ]);
        $terrains = Terrain::where('user_id','=',session('patient'))->where('supprimer', '=', false)->get();
    return view('forMedecin.consultation.terrain',compact('terrains') );
   }
   public function supTerrain($id){
    // dd('sup');
        Terrain::where('id', '=', $id)->update(['supprimer'=> true]);

    return redirect('/terrain')->with("ok", "Carte attribue avec succes!");
}

    public function accueilPatient(){
        return view("forPatient.accueil");
    }

    public function agenda(){
        $agenda = RV::join('users', 'users.id', '=', 'r_v_s.user_id')->where('medecin_id','=',Auth::user()->id)->where('r_v_s.supprimer', '=', false)->select('users.prenom', 'users.nom', 'users.prenom', 'r_v_s.daterv', 'r_v_s.heurerv', 'r_v_s.note', 'r_v_s.user_id')->orderBy('daterv', 'desc')->get();
        return view('forMedecin.agenda', compact('agenda'));
    }
    public function updatePassword(Request $request) {
                # Validation
                $request->validate([
                    'old_password' => 'required',
                    'new_password' => 'required|confirmed',
                ]);

                 #Match The Old Password
                if(!Hash::check($request->old_password, auth()->user()->password)){
                    if(Auth::user()->role == 'SECRETAIRE'){
                        return redirect('/accSec')->with("msg", "Password change avec succes!");
                    }
                    return back()->with("error", "les password ne correspondent pas!");
                }
                #Update the new Password
                User::whereId(auth()->user()->id)->update([
                    'password' => Hash::make($request->new_password)
                ]);
                if(Auth::user()->role == 'SECRETAIRE'){
                    return redirect('/accSec')->with("msg", "Password change avec succes!");
                }
                return back()->with("status", "Password change avec succes!");
    }

    // update patient
    public function updatePatient( Request $request ){


        User :: where('id', '=', $request->id )->update(['adresse'=> $request->adresse,'email'=> $request->email, 'tel'=> $request->tel,'statut'=> $request->statut ]);
        Patient::where('user_id','=', $request->id  )->update([ 'profession' => $request->profession,  'CNI' => $request->CNI,'tel_a_prevenir' => $request->tel_a_prevenir,]);

        $patient = User::join('patients','patients.user_id', '=','users.id')->where('medecin_id' , '=', Auth::user()->id)->where('users.supprimer', '=', false)->select('users.id', 'users.prenom','users.nom', 'users.email', 'users.sexe', 'users.date_nai', 'users.statut','users.tel', 'users.adresse','patients.sang', 'patients.profession', 'patients.allergie', 'patients.CNI','patients.tel_a_prevenir' )->get();
        return view('forMedecin.listePatient', compact('patient'));
    }
    public function documentation(){
        $pathos = Patho::all();
        return view('forMedecin.documentation', compact('pathos'));
    }
    //INFIRMIER
    public function accInf(){

        $consultations= Medecin::join('users', 'users.id', '=', 'medecins.user_id')->join('consultations', 'consultations.medecinuser_id','users.id' )->
            select('users.nom','consultations.numcons', 'consultations.motif', 'consultations.temperature', 'consultations.taille',
            'consultations.poids', 'consultations.IMC', 'consultations.glycemie', 'consultations.saturation', 'consultations.autresParaclinique',
            'consultations.pression', 'consultations.frequence', 'consultations.tdr', 'consultations.diagnostic', 'consultations.besoinpf', 'consultations.o2r',
            'consultations.observation', 'consultations.note', 'consultations.prenom', 'consultations.adresse', 'consultations.sexe',
            'consultations.user_id', 'consultations.id',
            'consultations.age', 'consultations.telephone', 'consultations.created_at' )->orderBy('consultations.created_at', 'desc')->get();
            //dd($consultations);
        return view('infirmier.accInf', compact('consultations'));
    }
    public function inf_consulter(Request $request){
        if($request->qrcode){
            if(!is_numeric($request->qrcode)){
                return redirect('/inf_consulter')->with('non-trouve', " veuillez utiliser une carte de Doctor's help");
            }
        }
        $qrcode = $request->qrcode;
        $monPatient = Patient::where('cartePatient', '=', $qrcode)->first();
        if (!$monPatient) {
            return redirect('/inf_consulter')->with('non-trouve', 'Patient non trouve');
        } else {
            $userpatient = User::where('id', '=', $monPatient->user_id)->first();
            session(['patient' => $userpatient->id]);
            return view('forMedecin.consultation.information', compact('userpatient', 'monPatient'));
        }
    }

    public function inf_consultercni(Request $request){
        if($request->CNI){
            if(!is_numeric($request->CNI)){
                return redirect('/consultation')->with('non-trouve', 'CNI non valide');
            }
        }
        $CNI = $request->CNI;
         //$administrator = Administrator::find($varId);
        //$administrator = Administrator::where('login','=','admin')->first();
        $monPatient = Patient::where('CNI', '=', $CNI)->first();  //OrFail();// pour gerer les exceptionj
        if (!$monPatient) {
            return redirect('/consultation')->with('non-trouve', 'Patient non trouve');
        } else {
            $userpatient = User::where('id', '=', $monPatient->user_id)->first();

            session(['patient' => $userpatient->id]);


            return view('forMedecin.consultation.information', compact('userpatient', 'monPatient'));
        }
    }

}
