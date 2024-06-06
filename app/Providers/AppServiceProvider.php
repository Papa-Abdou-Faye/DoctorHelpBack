<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
            // Code à exécuter à chaque démarrage de l'application
          $this->executerAChaqueDemarrage();
    }
    protected function executerAChaqueDemarrage()
    {
        // User::create([
        //     'nom' => 'Faye',
        //     'prenom' => 'Papa Abdou',
        //     'adresse' => 'Bambey',
        //     'date_nai' => '2024-06-04',
        //     'sexe' => 'Homme',
        //     'statut' => 'Celibataire',
        //     'email' => 'papafayelby@gmail.com',
        //     'tel' => '785386038',
        //     'role' => 'Admin',
        //     'password' => Hash::make('1234'),
        // ]);
    }

}
