<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    use HasFactory;

public function cuotas()
{
    return $this->hasMany(Cuota::class);
}

    
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
    // En el modelo Prestamo.php

    public function ruta()
    {
        return $this->belongsTo(Ruta::class);
    }

}
