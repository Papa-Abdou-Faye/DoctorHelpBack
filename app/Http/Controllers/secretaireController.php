<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\RV;
use App\Models\User;
use GuzzleHttp\Client;
use App\Models\Medecin;
use App\Models\Patient;
use App\Models\PersoQueu;
use App\Models\Listpatien;
use App\Models\Secretaire;
use GuzzleHttp\Promise\Create;
use Illuminate\Contracts\Session\Session;
use Infobip\Configuration;
use Infobip\Api\SendSmsApi;
use Illuminate\Http\Request;
use Infobip\Model\SmsDestination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Infobip\Model\SmsTextualMessage;
use Illuminate\Validation\Rules\Exists;
use Infobip\Model\SmsAdvancedTextualRequest;

class secretaireController extends Controller
{
    //
    public function accSec(){
        $secretaires = Secretaire::where('user_id', '=', Auth::user()->id)->firstOrFail();
        $medecins = DB::table('medecins')->where('id_secretaire1', '=',  $secretaires->id)->orwhere('id_secretaire2', '=',  $secretaires->id)->orwhere('id_secretaire3', '=',  $secretaires->id)->get();
       // dd($medecins);
        for( $i = 0; $i < $medecins->count(); $i++){
            $med[$i] = DB::table('users')->where('id', '=', $medecins[$i]->user_id)->first();
        }
        $z = -1;
        $y = -1;
        for( $j = 0; $j < $medecins->count(); $j++){
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
           $daterv = date("d-m-Y");;
           return view('forSecretaire.accueil', compact('rv','rvs2','daterv'));
        }else{
            $rv = collect($rvs);
            $daterv = date('d-m-Y',strtotime ( $rvs[$z]->daterv));
            //$daterv = $rvs[$z]->daterv;
            return view('forSecretaire.accueil', compact('rv','rvs2','daterv'));
        }
    }
    public function insPatient(){
        return view('forSecretaire.inspatient');
    }
    public function enregistrerPatient(Request $request){
        $request->validate(['post',
        'nom' => ['required', 'string', 'max:50'],
        'prenom' => ['required', 'string', 'max:50'],
        'adresse' => ['required', 'string', 'max:50'],
        'date_nai'=> ['required', 'date', 'before:today'],
        'sexe' => ['required', 'string', 'max:255'],
        // 'email' => ['required','email', 'max:100', 'unique:users'],
        // 'tel' => ['required', 'numeric','digits:9', 'unique:users'],
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
         'role' => 'PATIENT',
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

                            $SENDER = "Dr'S HELP";
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
    public function ajoutSec($id){
        $med = Medecin::where('user_id', '=', Auth::user()->id)->firstOrFail();
        if($med->id_secretaire1 == null){
            Medecin::where('user_id', '=', Auth::user()->id)->update(['id_secretaire1'=>$id]);
            return redirect('/acc')->with("msgsec", "Secretaire Ajouté avec succés");
        }elseif($med->id_secretaire2 == null){
            Medecin::where('user_id', '=', Auth::user()->id)->update(['id_secretaire2'=>$id]);
            return redirect('/acc')->with("msgsec", "Secretaire Ajouté avec succés");
        }elseif($med->id_secretaire3 == null){
            Medecin::where('user_id', '=', Auth::user()->id)->update(['id_secretaire3'=>$id]);
            return redirect('/acc')->with("msgsec", "Secretaire Ajouté avec succés");
        }else{
            return redirect('/acc')->with("msgsec", "Vous ne pouvez pas avoir plus de trois secretaires");
        }
    }
    public function elimSec($id){
        $med = Medecin::where('user_id', '=', Auth::user()->id)->firstOrFail();
        if($med->id_secretaire1 == $id){
            Medecin::where('user_id', '=', Auth::user()->id)->update(['id_secretaire1'=>null]);
            return redirect('/acc')->with("msgsec", "Secretaire Eliminé avec succés");
        }elseif($med->id_secretaire2 == $id){
            Medecin::where('user_id', '=', Auth::user()->id)->update(['id_secretaire2'=>null]);
            return redirect('/acc')->with("msgsec", "Secretaire Eliminé avec succés");
        }elseif($med->id_secretaire3 == $id){
            Medecin::where('user_id', '=', Auth::user()->id)->update(['id_secretaire3'=>null]);
            return redirect('/acc')->with("msgsec", "Secretaire Eliminé avec succés");
        }else{
            return redirect('/acc')->with("msgsec", "Vous nùqvew pas de secretaire");
        }
    }
    public function alertsms($id){
        $patient = User::where("id", $id)->firstOrFail();
        session(['cl_a_sms' => $patient]);
        return view('forSecretaire.alert', compact('patient'));
    }
    public function rpt($id) {
        $patient = User::where("id", $id)->firstOrFail();
        session(['cl_a_sms' => $patient]);
        return view('forSecretaire.rpt', compact('patient'));
    }
    public function envAlertsms(){
        $rv = RV::latest()->where('user_id', '=',Session('cl_a_sms')->id)->firstOrFail();
        //dd($rv);
        $medecin = user::where('id', '=', $rv->medecin_id)->firstOrFail();
        if(!session('cl_a_sms')->tel){
            return redirect()->back();
        }
        $BASE_URL = "https://dm4me1.api.infobip.com";
        $API_KEY = "cbb5e46dd28e62a771789d2917236f10-28445fa3-7849-4fca-9d1d-b1af47f2745f";

        $SENDER = "Dr's Help";
        $RECIPIENT='221'.session('cl_a_sms')->tel;
        $MESSAGE_TEXT="Bonjour " .session('cl_a_sms')->prenom ." ". session('cl_a_sms')->nom . "\nN'oubliez pas votre renedez-vous avec Dr " . $medecin->nom ." demain le " . $rv->daterv . " à " . $rv->heurerv . "\nDoctor's Help vous souhaite un bon rétablissement !" ;

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
            return redirect('/accSec');
            echo ("Response body: " . $smsResponse);
        } catch (Throwable $apiException) {
            echo("HTTP Code: " . $apiException->getCode() . "\n");
        }
    }
    public function envRptsms( Request $request){
        $request->validate(['post',
        'daterv' => ['date', 'required'],
        'heurerv' => ['required'],
    ]);
        $rv_encours = RV::latest()->where('user_id', '=',Session('cl_a_sms')->id)->firstOrFail();
        //dd($rv);
        $medecin = user::where('id', '=', $rv_encours->medecin_id)->firstOrFail();
        if(!session('cl_a_sms')->tel){
            return redirect()->back();
        }
        $rv = RV::where('id', '=', $rv_encours->id)->update(['daterv' => $request->daterv,'heurerv' => $request->heurerv,]);
        $BASE_URL = "https://dm4me1.api.infobip.com";
        $API_KEY = "cbb5e46dd28e62a771789d2917236f10-28445fa3-7849-4fca-9d1d-b1af47f2745f";

        $SENDER = "Dr's Help";
        $RECIPIENT='221'.session('cl_a_sms')->tel;
        $MESSAGE_TEXT="Bonjour " .session('cl_a_sms')->prenom ." ". session('cl_a_sms')->nom . "\nN'oubliez pas votre renedez-vous avec Dr " . $medecin->nom ." demain le " . $rv->daterv . " à " . $rv->heurerv . "\nDoctor's Help vous souhaite un bon rétablissement !" ;

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
            return redirect('/accSec');
            echo ("Response body: " . $smsResponse);
        } catch (Throwable $apiException) {
            echo("HTTP Code: " . $apiException->getCode() . "\n");
        }
    }
    public function persoAlertSms(Request $request){
        $rv = RV::latest()->where('user_id', '=',Session('cl_a_sms')->id)->firstOrFail();
        //dd($rv);
        $medecin = user::where('id', '=', $rv->medecin_id)->firstOrFail();
        if(!session('cl_a_sms')->tel){
            return redirect()->back();
        }
        $BASE_URL = "https://dm4me1.api.infobip.com";
        $API_KEY = "cbb5e46dd28e62a771789d2917236f10-28445fa3-7849-4fca-9d1d-b1af47f2745f";

        $SENDER = "Dr's Help";
        $RECIPIENT='221'.session('cl_a_sms')->tel ;
        $MESSAGE_TEXT = $request->msg ;

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
            return redirect('/accSec');
            echo ("Response body: " . $smsResponse);
        } catch (Throwable $apiException) {
            echo("HTTP Code: " . $apiException->getCode() . "\n");
        }
    }
    public function persoRptSms(Request $request){
        $rv_encours = RV::latest()->where('user_id', '=',Session('cl_a_sms')->id)->firstOrFail();
        //dd($rv);
        $medecin = user::where('id', '=', $rv_encours->medecin_id)->firstOrFail();
        if(!session('cl_a_sms')->tel){
            return redirect()->back();
        }
        $rv = RV::where('id', '=', $rv_encours->id)->update(['daterv' => $request->daterv,'heurerv' => $request->heurerv,]);
        $BASE_URL = "https://dm4me1.api.infobip.com";
        $API_KEY = "cbb5e46dd28e62a771789d2917236f10-28445fa3-7849-4fca-9d1d-b1af47f2745f";

        $SENDER = "Dr's Help";
        $RECIPIENT='221'.session('cl_a_sms')->tel ;
        $MESSAGE_TEXT = $request->msg ;

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
            return redirect('/accSec');
            echo ("Response body: " . $smsResponse);
        } catch (Throwable $apiException) {
            echo("HTTP Code: " . $apiException->getCode() . "\n");
        }
    }
    public function listMedSec(){
        //$sec = DB::table('users')->where('id', '=',  Auth::user()->id)->orwhere('id', '=',  Auth::user()->id)->orwhere('id', '=',  Auth::user()->id)->get();
        $sec = Secretaire::where('user_id', Auth::user()->id)->first();
        //dd($sec);
        $m = Medecin::where('stricture_id', '=', $sec->stricture_id)->get();
        for( $i = 0; $i < $m->count(); $i++){
            $medecin = Medecin::where('id_secretaire1', '=',  $sec->id)->orwhere('id_secretaire2', '=',  $sec->id)->orwhere('id_secretaire3', '=',  $sec->id)->get();
        }

        if($medecin->count() > 0){
            $j = -1;
           foreach ($medecin as $key => $value) {
            $j++;
            $mdc[$j] = User::where('id', '=', $value->user_id)->first();
           }
           $medecins = collect($mdc);
           //dd($medecins);
            return view('forSecretaire.listeMed', compact('medecins'));
        }else{
            $medecins = User::where('id', '=', '-1');
            return view('forSecretaire.listeMed', compact('medecins'));
        }
    }
    public function Queu($id){
        $u = User::where('id', '=', $id)->firstOrFail();
        Listpatien::create([
            'secretaire_id' => Auth::user()->id,
            'nom' => date('d-m-Y H:i:s').' Dc '.$u->nom,
            'dateliste' =>  date('y/m/d'),
            'medecin_id' =>$id ,
        ]);
        return redirect('/listForCons');
    }
    public  function listForCons(){
        $listes = Listpatien::latest()->where('secretaire_id', '=', Auth::user()->id)->get();
        if($listes->count() > 0){
            $liste = Listpatien::latest()->where('secretaire_id', '=', Auth::user()->id)->firstOrFail();
            $persoQueu =  PersoQueu::where('listpatien_id', '=', $liste->id)->get();
            session(['list_first' => true]);
            session(['listePersonQue' => $liste->id]);
            /// les medecins
            $sec = Secretaire::where('user_id', Auth::user()->id)->first();
            //dd($sec);
            $m = Medecin::where('stricture_id', '=', $sec->stricture_id)->get();
            for( $i = 0; $i < $m->count(); $i++){
                $medecin = Medecin::where('id_secretaire1', '=',  $sec->id)->orwhere('id_secretaire2', '=',  $sec->id)->orwhere('id_secretaire3', '=',  $sec->id)->get();
            }

            if($medecin->count() > 0){
                $j = -1;
               foreach ($medecin as $key => $value) {
                $j++;
                $mdc[$j] = User::where('id', '=', $value->user_id)->first();
               }
               $medecins = collect($mdc);
               //dd($medecins);

            }else{
                $medecins = User::where('id', '=', '-1');
                //dd($medecins);
            }
            return view('forSecretaire.queu', compact('listes', 'persoQueu', 'liste', 'medecins'));
        }else{
            $sec = Secretaire::where('user_id', Auth::user()->id)->first();
            //dd($sec);
            $m = Medecin::where('stricture_id', '=', $sec->stricture_id)->get();
            for( $i = 0; $i < $m->count(); $i++){
                $medecin = Medecin::where('id_secretaire1', '=',  $sec->id)->orwhere('id_secretaire2', '=',  $sec->id)->orwhere('id_secretaire3', '=',  $sec->id)->get();
            }

            if($medecin->count() > 0){
                $j = -1;
               foreach ($medecin as $key => $value) {
                $j++;
                $mdc[$j] = User::where('id', '=', $value->user_id)->first();
               }
               $medecins = collect($mdc);
               //dd($medecins);

            }else{
                $medecins = User::where('id', '=', '-1');
                //dd($medecins);
            }
            session(['list_first' => false]);
            return view('forSecretaire.queu', compact('medecins'));
        }
    }
    public function ajoutAuQueu( Request $request){
        $request->validate(['post',
        'nom' => ['required', 'string', 'max:50'],
        'prenom' => ['required', 'string', 'max:50'],
    ]);

        PersoQueu::create([
            'listpatien_id' => session('listePersonQue'),
            'prenom' => $request->prenom,
            'nom' => $request->nom
        ]);
        return redirect('/listForCons');
    }
    public function voirqueu($id){
        $listes = Listpatien::latest()->where('secretaire_id', '=', Auth::user()->id)->get();
        $liste = Listpatien::latest()->where('id', '=', $id)->firstOrFail();
        $persoQueu =  PersoQueu::where('listpatien_id', '=', $id)->get();
        session(['list_first' => true]);
        session(['listePersonQue' => $id]);

        // medecin

        $sec = Secretaire::where('user_id', Auth::user()->id)->first();
        //dd($sec);
        $m = Medecin::where('stricture_id', '=', $sec->stricture_id)->get();
        for( $i = 0; $i < $m->count(); $i++){
            $medecin = Medecin::where('id_secretaire1', '=',  $sec->id)->orwhere('id_secretaire2', '=',  $sec->id)->orwhere('id_secretaire3', '=',  $sec->id)->get();
        }

        if($medecin->count() > 0){
            $j = -1;
           foreach ($medecin as $key => $value) {
            $j++;
            $mdc[$j] = User::where('id', '=', $value->user_id)->first();
           }
           $medecins = collect($mdc);
           //dd($medecins);

        }else{
            $medecins = User::where('id', '=', '-1');
        }
        return view('forSecretaire.queu', compact('listes', 'persoQueu', 'liste', 'medecins'));
    }
    public function agendaSec(){
        $medecins = Medecin::where('id_secretaire', '=',Auth::user()->id)->get;
    }
}
