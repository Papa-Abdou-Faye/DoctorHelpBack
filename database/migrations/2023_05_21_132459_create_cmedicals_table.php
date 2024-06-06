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
        Schema::create('cmedicals', function (Blueprint $table) {
            $table->id();
            $table->string('pathologie');
            $table->string('lieu_nai');
            $table->date('datecmedical');
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
        Schema::dropIfExists('cmedicals');
    }
};
