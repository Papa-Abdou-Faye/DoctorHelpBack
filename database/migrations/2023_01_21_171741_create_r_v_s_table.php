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
        Schema::create('r_v_s', function (Blueprint $table) {
            $table->id();
            $table->date('daterv');
            $table->time('heurerv');
            $table->string('note');
            $table->boolean('supprimer')->default(false);
            $table->enum('statut',['Raté', 'Passé', '---'])->default('---');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('medecin_id');
            $table->foreign('medecin_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('r_v_s');
    }
};
