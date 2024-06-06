<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Medecin;
use App\Models\Patient;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'nom' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ])->validate();
        // if($input['role']=='PersonnelSoignant'){
        //    $m= Medecin::create([
        //         'nom' =>  $input['nom'],
        //         'prenom' => $input['prenom'],
        //         'adresse' => $input['adresse'],
        //         'date_nai' => $input['date_nai'],
        //         'sexe' => $input['sexe'],
        //         'statut' => $input['statut'],
        //         'email' => $input['email'],
        //         'tel' => $input['tel'],
        //         'role' => $input['role'],
        //         'qualite' => $input['qualite'],
        //     ]);
        //     dd($m);
        // }elseif('role'=='patient'){
        //     $allergie = null;
        // if($input['allergie'] == null ){
        //    $allergie = "";
        // }else{
        //     $allergie = $input['allergie'];
        // }
        // Patient::create([
        //     'nom' => $input['nom'],
        //     'prenom' => $input['prenom'],
        //     'adresse' => $input['adresse'],
        //     'date_nai' => $input['date_nai'],
        //     'sexe' => $input['sexe'],
        //     'statut' => $input['statut'],
        //     'email' => $input['email'],
        //     'tel' => $input['tel'],
        //     'role' => $input['role'],
        //     'profession' => $input['profession'],
        //     'sang' => $input['sang'],
        //     'allergie' => $allergie,
        //     'nom_a_prevenir' => $input['nom_a_prevenir'],
        //     'tel_a_prevenir' => $input['tel_a_prevenir'],
        // ]);
        // }
        
        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'role' => $input['role'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
