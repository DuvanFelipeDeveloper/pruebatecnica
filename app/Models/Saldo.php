<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saldo extends Model
{
    use HasFactory;

    protected $fillable = [
        'cantidad_retiro',
        'user_id',
        'estado_id'  
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function estado(){
        return $this->belongsTo(Estado::class);
    }

}
