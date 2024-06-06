<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RV extends Model
{
    use HasFactory;
    protected $fillable = [ 'id',
    'daterv', 
    'heurerv',
    'user_id', 
    'medecin_id',
    'note',
    'supprimer' ];
}
