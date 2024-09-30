<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    use HasFactory;


    protected $fillable = [
        'id',
        'nombre',
        'codigo',
        'estado',
        'genero_id',
    ];


    public function prestamos(){
        return $this->hasMany(Prestamo::class);
    }
}
