<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicament extends Model
{
    use HasFactory;
    protected $fillable = ['id','ordennance_id', 'medicament', 'matin', 'midi','soire', 'quantite'];
}
