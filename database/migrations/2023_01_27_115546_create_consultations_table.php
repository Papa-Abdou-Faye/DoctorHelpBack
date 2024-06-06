<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->date('datecons')->nullable();
            $table->string('numcons')->nullable();
            $table->string('motif')->nullable();
            // constantes
            $table->string('temperature')->nullable();
            $table->string('taille')->nullable();
            $table->string('poids')->nullable();
            $table->string('IMC')->nullable();
            $table->string('frequence')->nullable();
            $table->string('pression')->nullable();
            $table->string('glycemie')->nullable();
            $table->string('saturation')->nullable();
            // exame
            $table->string('tdr')->nullable();
            $table->string('autresParaclinique')->nullable();
            $table->string('diagnostic')->nullable();
            $table->string('o2r')->nullable();
            $table->string('traitement')->nullable();
            $table->string('besoinpf')->nullable();
            $table->string('observation')->nullable();
            // notes de consultation
            $table->string('note')->nullable();
            // patient non enregistrer
            $table->string('nom')->nullable();
            $table->string('prenom')->nullable();
            $table->string('adresse')->nullable();
            $table->string('sexe')->nullable();
            $table->string('age')->nullable();
            $table->string('profession')->nullable();
            $table->string('status')->nullable();
            $table->string('telephone')->nullable();
            //autres
            $table->string('medecinuser_id');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consultations');
    }
};
