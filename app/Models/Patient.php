<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'user_id',
        'profession',
        'sang',
        'allergie',
        'medecin_id',
        'CNI',
        'cartePatient', 
        'tel_a_prevenir'];
        public function user(){
            return $this->belongsTo(User::class);
        }
    
        public function antecedents(){
            return $this->hasMany(Antecedent::class);
        }
}
