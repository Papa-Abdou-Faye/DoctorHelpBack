<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'user_id',
        // constante
        'numcons',
        'motif',
        'temperature',
        'taille',
        'poids',
        'IMC',
        'pression',
        'frequence',
        'glycemie',
        'saturation',
        // exames
        'tdr',
        'autresParaclinique',
        'diagnostic',
        'o2r',
        'besoinpf',
        'observation',
        'traitement',
        'note',
        // patient non inscrit
        'nom',
        'prenom',
        'adresse',
        'sexe',
        'age',
        'profession',
        'status',
        'telephone',
        //---------------
        'datecons',
        'medecinuser_id',
    ];
        public function user(){
            return $this->belongsTo(User::class);
        }
}
