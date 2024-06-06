<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cmedicalrepos extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'incapacite',
        'datecrmedical',
        'pathologie',
        'user_id',
        'medecinuser_id',
        'consultation_id'
    ];
}
