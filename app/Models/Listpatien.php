<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listpatien extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'nom',
        'secretaire_id',
        'dateliste',
        'medecin_id'
    ];
}
