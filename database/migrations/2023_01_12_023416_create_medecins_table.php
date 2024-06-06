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
        Schema::create('medecins', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('user_id');
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('id_secretaire1')->nullable();
            $table->string('id_secretaire2')->nullable();
            $table->string('id_secretaire3')->nullable();
            $table->string('stricture_id');
            $table->string('nom');
            $table->string('prenom');
            $table->string('adresse');
            $table->date('date_nai');
            $table->enum('sexe',['Femme','Homme']);
            $table->string('email')->unique();
            $table->string('tel')->unique()->nullable();
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
        Schema::dropIfExists('medecins');
    }
};
