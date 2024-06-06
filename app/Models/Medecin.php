<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medecin extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'user_id',
        'id_secretaire1',
        'id_secretaire2',
        'id_secretaire3',
        'stricture_id',
        'nom',
        'prenom',
        'adresse',
        'date_nai',
        'sexe',
        'email',
        'tel',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
