<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Secretaire extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'user_id',
        'nom',
        'prenom',
        'adresse',
        'sexe',
        'telephone',
        'stricture_id'
    ];

}
