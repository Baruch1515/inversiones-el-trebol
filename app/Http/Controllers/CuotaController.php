<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prestamo;
use App\Models\Cuota;

class CuotaController extends Controller
{
    //
    public function index()
    {
        $prestamos = Prestamo::all(); 
        return view('nuevacuotas', compact("prestamos"));
    }


    public function store(Request $request)
    {
        $prestamo = Prestamo::findOrFail($request->input('prestamo'));
    
        // Eliminar signo de dólar y puntos del monto_cuota
        $montoCuota = str_replace(['$', ','], '', $request->input('monto_cuota'));
    
        // Crear nueva cuota
        $cuota = new Cuota();
        $cuota->prestamo_id = $prestamo->id;
        $cuota->monto_cuota = $montoCuota;
        $cuota->fecha = $request->input('fecha');
        $cuota->save();
    
        // Actualizar el dinero_total del préstamo
        $prestamo->dinero_total -= $montoCuota;
        $prestamo->save();
    
        return redirect()->back()->with('success', 'Cuota agregada exitosamente.');
    }

    public function ver(){
        $cuotas = Cuota::all(); 
        return view("vercuotas", compact("cuotas"));
    }

    

}
