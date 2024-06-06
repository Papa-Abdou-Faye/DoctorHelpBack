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
        Schema::create('paracliniques', function (Blueprint $table) {
            $table->id();
            $table->string('exam');
            $table->string('diagnostic')->nullable();
            $table->string('medecinuser_id');
            $table->string('consultation_id');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('paracliniques');
    }
};
