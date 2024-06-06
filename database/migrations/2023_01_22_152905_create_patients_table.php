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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('profession')->nullable();
            $table->string('sang')->nullable();
            $table->unsignedBigInteger('cartePatient')->unique()->nullable();
            $table->string('allergie')->nullable();
            $table->string('CNI')->nullable();
            $table->string('tel_a_prevenir')->nullable();
            $table->string('medecin_id');
            $table->boolean('supprimer')->default(false);
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
        Schema::dropIfExists('patients');
    }
};
