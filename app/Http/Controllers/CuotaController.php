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
        
        // Reducir el número de cuotas en 1
        $prestamo->cuotas--;
    
        // Verificar si todas las cuotas han sido pagadas
        if ($prestamo->cuotas == 0) {
            $prestamo->estado = 'Pagado';
        }
        
        $prestamo->save();
    
        return redirect()->back()->with('success', 'Cuota agregada exitosamente.');
    }
    

    public function ver(){
        $cuotas = Cuota::all(); 
        return view("vercuotas", compact("cuotas"));
    }

    public function destroy(Cuota $cuota)
    {
        // Obtén el prestamo relacionado
        $prestamo = $cuota->prestamo;
    
        // Actualiza el campo dinero_total sumándole el valor de la cuota eliminada
        $prestamo->dinero_total += $cuota->monto_cuota;
    
        // Guarda los cambios en el prestamo
        $prestamo->save();
    
        // Elimina la cuota
        $cuota->delete();
    
        return redirect()->back()->with('success', 'Cuota eliminada correctamente.');
    }
    
     

}
