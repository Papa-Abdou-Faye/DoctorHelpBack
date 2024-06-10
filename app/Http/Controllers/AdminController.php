<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Patho;
use App\Models\QrCode;
use App\Models\Medecin;
use App\Models\Patient;
use App\Models\personel;
use App\Models\Stricture;
use App\Models\Secretaire;
use Illuminate\Http\Request;
use App\Models\Administrator;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Administrator::all();
        //dd($admins);
        return view('admin',['adm'=> $admins] );
    }
    public function show($varId){
        //$administrator = Administrator::find($varId);
        //$administrator = Administrator::where('login','=','admin')->first();
        $administrator = Administrator::where('login','=','admine')->firstOrFail();// pour gerer les exceptionj
        //dd($administrator);
        return view('home',['administrator'=> $administrator]);
    }

    // connexion
    public function login(Request $donneesRequte){
        //dd($donneesRequte->login, $donneesRequte->password);
        return view('administrateur',[
            'password'=>$donneesRequte->password,
            'username'=>$donneesRequte->login
        ]);
    }

    public function accueil() {
        return view('forAdmin.accueil');
    }


    // formulaire d'inscription medecin
      public function insMed(){
        $strictures = Stricture::all();
        return view('forAdmin.inscriptionMed', compact('strictures'));
    }
    use RegistersUsers;

    public function ajouterMedecin(Request $request){

        $request->validate(['post',
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'adresse' => ['required', 'string', 'max:255'],
            'date_nai'=> ['required', 'date', 'before:today'],
            'sexe' => ['required', 'string', 'max:255'],
            'tel' => ['required', 'string', 'digits:9', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:4'],
        ]);
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
        if($request->role == 'MEDECIN' || $request->role == 'MEDECINCHEF'){
         Medecin::create([
            'user_id'=> $user->id,
            'nom' => $request->nom,
            'prenom'=> $request->prenom,
            'adresse'=> $request->adresse,
            'sexe'=> $request->sexe,
            'date_nai' => $request->date_nai,
            'telephone' => $request->tel,
            'email' => $request->email,
            'stricture_id' => $request->stricture,
        ]);}elseif( $request->role == 'SECRETAIRE'){
            Secretaire::create([
                'user_id'=> $user->id,
                'nom' => $request->nom,
                'prenom'=> $request->prenom,
                'adresse'=> $request->adresse,
                'sexe'=> $request->sexe,
                'telephone' => $request->tel,
                'stricture_id' => $request->stricture,
            ]);
        }
        if(Auth::user()->role == 'MEDECIN' || Auth::user()->role== 'MEDECINCHEF'){
            return redirect('/acc')->with('succes','Le Personnel Soignant a ete enregistre.');
        }
            return redirect('/insMed')->with('succes','Le Personnel Soignant a ete enregistre.');
    }
    // public function regMed(){

    //     return redirect('/medreg')->with('insMed', 'inscrir medecin');
    // }

    public function listMed(){
        $personnel = Medecin::join('users', 'users.id', '=', 'medecins.user_id')->where('users.supprimer', '=', false)->get();
        return view('forAdmin.personnel', compact('personnel'));
    }
    public function page(){
        return view('forAdmin.qrcode');
    }

    public function generer(){
        for ($i=0; $i < 40 ; $i++) {
            # code...
            QrCode::create(['qrcodeContenu'=> generateBarcodeNumber() ]);
        }

        return redirect('/pageqrcode')->with('succes','les QrCodes ont ete generer avec succes');
    }
    public function qrLister(){
        $qrcodes = QrCode::all();
        return view('forAdmin.listeQrcode' , ['qrcodes'=>  $qrcodes]);
    }

    // anomali
    public function anomalie(){
         $ano = Patho::all();

        return view('forAdmin.anomalie',['pathologies'=>$ano]);
    }
    public function ajoutAnomalie(Request $request){

        // traitement
        Patho::create([
            'nom' => $request->nom,
            'desc' => $request->desc,
            'traitements' => $request->traite,
        ]);
        $ano = Patho::all();
        return view('forAdmin.anomalie', ['pathologies'=>$ano]);
    }

    public function stricture(){
        $strictures = Stricture::all();
        return response()->json([
            "status" => 200,
            // "message" => "User connecter avec succes",
            // "user" => auth()->user(),
            "strictures" => $strictures
        ]);
        // return view('forAdmin.stricture',compact('strictures'));
    }
    public function ajouterStricture(Request $request){
        // dd($request);
        Stricture::create([
            'nom'=>$request->nom,
            'Adresse'=>$request->adresse,
            'telephone'=>$request->telephone,
        ]);
        $strictures = Stricture::all();
        return response()->json([
            "status" => 200,
            "message" => "User connecter avec succes",
            // "user" => auth()->user(),
            "strictures" => $strictures
        ]);
    //    return redirect('/stricture');
    }

}

function generateBarcodeNumber() {
    $number = mt_Rand(100000000000000, 999999999999999); // better than Rand()

    // call the same function if the barcode exists already
    if (barcodeNumberExists($number)) {
        return generateBarcodeNumber();
    }

    // otherwise, it's valid and can be used
    return $number;
}

function barcodeNumberExists($number) {
    // query the database and return a boolean
    // for instance, it might look like this in Laravel
    return QrCode::whereqrcodecontenu($number)->exists() ;
}
