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
        Schema::create('cvmedicals', function (Blueprint $table) {
            $table->id();
            $table->date('datecvmedical');
            $table->string('lieu_nai');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('medecinuser_id');
            $table->string('consultation_id');
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
        Schema::dropIfExists('cvmedicals');
    }
};
