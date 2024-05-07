<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruta extends Model
{
    use HasFactory;
    public function prestamos()
    {
        return $this->hasMany(Prestamo::class);
    }
    protected $fillable = [
        'nombre',
        // Agrega aquí los otros campos fillable que tengas en tu modelo
        '_token', // Agrega '_token' a la lista fillable
    ];
    
}
