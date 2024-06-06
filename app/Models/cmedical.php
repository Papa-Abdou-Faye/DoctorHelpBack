<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cmedical extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'pathologie',
        'datecmedical',
        'lieu_nai',
        'user_id',
        'medecinuser_id',
        'consultation_id'
    ];
}
