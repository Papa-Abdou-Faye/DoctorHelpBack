<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ccvmedical extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'datecvmedical',
        'lieu_nai',
        'user_id',
        'medecinuser_id',
        'consultation_id'
    ];
}
