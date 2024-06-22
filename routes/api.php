<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\medecinController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Authentification
// Route::get('/', function () {
//     return view('auth.login');
// });

Route::post('/authlogin', [AuthController::class, 'login'])->name(name:'authlogin');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Espace Administrateur
                            //  =========================Cabient ======================
Route::post('/ajouterstricture', [AdminController::class, 'ajouterStricture'])->name('ajouterStricture');
Route::get('/structure', [AdminController::class, 'structure'])->name('Structure');
                            //  =========================Inscription ======================
Route::post('/ajouterPersonnelSoignant', [AdminController::class, 'ajouterMedecin'])->name('enregisterMedecin.admin');
                            // =========================cabinet chef ======================
Route::get('/listePersonnel', [AdminController::class, 'listeMedecin'])->name('list.med');
                            // =========================Qrcode  ======================
Route::get('/genererQrCode', [AdminController::class, 'generer'])->name('pageqrcode.admin');
Route::get('/getQrCode', [AdminController::class, 'qrLister'])->name('pageqrcode.admin');

// Espace Medecin
//                              =========================Accueil ======================
Route::get('/accueil', [medecinController::class, 'accMed'])->name('acc');
    Route::get('/dropdown', [HomeController::class, 'dropdown'])->name('dropdown');

