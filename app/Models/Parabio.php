<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parabio extends Model
{
    use HasFactory;
    protected $fillable = ['id','user_id','medecinuser_id', 'consultation_id', 'supprimer'];
}
