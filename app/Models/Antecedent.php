<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antecedent extends Model
{
    use HasFactory;
    protected $fillable = ['id','user_id','pathologie','type','note','supprimer'];
    public function user(){
        return $this->belongsTo(Patient::class);
    }
}
