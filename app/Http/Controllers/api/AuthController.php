<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\JWT;

class AuthController extends Controller
{
    //
    // public function register(Request $request) {
    //     try{
    //         $data = $request->validate([
    //             // "name" => "required",
    //             // "email" => "required|email|unique:users",
    //             // "password" => "required|confirmed",

    //             'nom' => ['required', 'string', 'max:255'],
    //             'prenom' => ['required', 'string', 'max:255'],
    //             'adresse' => ['required', 'string', 'max:255'],
    //             'date_nai'=> ['required', 'date', 'max:255'],
    //             'sexe' => ['required', 'string', 'max:255'],
    //             'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //             'password' => ['required', 'string', 'min:8'],

    //         ]);
    //     }catch(Throwable $e){

    //     }


    //     $data['password'] = Hash::make($request->input(key: 'password'));

    //     $user = User::create($data);

    //     return response()->json([
    //         "status" => 201,
    //         "message" => "User created successfully",
    //         "data" => $user,
    //         "token" => null
    //     ]);
    // }


    public function login(Request $request) {

        $data = $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        $token = JWTAuth::attempt($data);

        if(!empty($token)){
            return response()->json([
                "status" => 200,
                "message" => "User connecter avec succes",
                "token" => $token,
                // "user" => Auth::user()->role,
                "user" => auth()->user()

            ]);
        }else{
            return response()->json([
                "status" => false,
                 "message" => "L'mail ou mot de passe incorrecte",
                "token" => null,
                "data" => $data
            ]);
        }
    }


    public function logout() {
         auth()->logout();

         return response()->json([
             "status" => true,
             "message" => "User logged out successfully",
             "tokon" => null
         ]);
    }

    public function refresh() {
        $newtoken = JWTAuth::refresh();

        return response()->json([
            "status" => true,
            "message" => "Token refreshed successfully",
            "token" => $newtoken
        ]);
    }
}
