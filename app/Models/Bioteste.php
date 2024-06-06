<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bioteste extends Model
{
    use HasFactory;
    protected $fillable = ['id','parabio_id', 'teste'];
}
