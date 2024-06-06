<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordennance extends Model
{
    use HasFactory;
    protected $fillable = ['id','user_id','medecinuser_id', 'consultation_id'];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
