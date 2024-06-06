<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cmedicalplus extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'diagnostic',
        'incapacite',
        'datecmedical',
        'dateaccident',
        'lieu_nai',
        'user_id',
        'medecinuser_id',
        'consultation_id'
    ];
}
