<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Prestamo;
use App\Models\Cuota;
use App\Models\Cliente;

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
    
        // Obtener el monto de la cuota introducido por el administrador
        $montoCuota = str_replace(['$', '.'], '', $request->input('monto_cuota'));
    
        // Verificar si el monto de la cuota excede el dinero_total del préstamo
        if ($montoCuota > $prestamo->dinero_total) {
            return redirect()->back()->with('error', 'El monto de la cuota no puede exceder el dinero total del préstamo.');
        }
    
        // Crear nueva cuota
        $cuota = new Cuota();
        $cuota->prestamo_id = $prestamo->id;
        $cuota->monto_cuota = $montoCuota;
        $cuota->fecha = $request->input('fecha');
        $cuota->save();
    
        // Actualizar el dinero_total del préstamo
        $prestamo->dinero_total -= $montoCuota;
    
        // Verificar si todas las cuotas han sido pagadas
        if ($prestamo->cuotas == 0) {
            $prestamo->estado = 'Pagado';
        }
    
        $prestamo->save();
    
        return redirect()->back()->with('success', 'Cuota agregada exitosamente.');
    }
    
    public function ver(Request $request) {
        // Obtén todos los clientes para mostrar en el select
        $clientes = Cliente::all();
        // Obtén el cliente seleccionado
        $clienteId = $request->input('cliente_id');
        // Obtén las cuotas asociadas al cliente seleccionado
        $cuotas = Cuota::whereHas('prestamo', function($query) use ($clienteId) {
            $query->where('cliente_id', $clienteId);
        })->get();
        // Retorna la vista 'vercuotas' con las cuotas asociadas al cliente y los clientes disponibles
        return view('vercuotas', compact('cuotas', 'clientes'));
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
