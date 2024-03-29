<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Prestamo;
use Illuminate\Support\Facades\DB;
class PrestamosController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all(); 
        return view("nuevo-prestamo", compact('clientes'));
    }

    public function dashboard(Request $request)
    {
        $diaCobro = $request->cobro;
        
        $prestamos = Prestamo::query();
    
        // Verificar si se ha seleccionado un día de cobro
        if (!empty($diaCobro)) {
            $prestamos->where('cobro', 'LIKE', "%$diaCobro%");
        }
    
        $prestamos = $prestamos->get();
    
        return view('dashboard', compact('prestamos', 'diaCobro'));
    }
    
    public function store(Request $request)
    {
        $prestamo = new Prestamo();
        $prestamo->cliente_id = $request->cliente;
        $prestamo->monto = str_replace(['$', ','], '', $request->monto);
        $prestamo->cuotas = intval($request->cuotas);
        $prestamo->intereses = $request->intereses;
        $prestamo->nota = $request->nota;
        $prestamo->cobro = implode(', ', $request->cobro);
        $prestamo->monto_cuota = str_replace(['$', ','], '', $request->monto_cuota);
        $prestamo->ganancia = $request->ganancia;
        $prestamo->dinero_total = $prestamo->monto + $prestamo->ganancia; // Calcula el valor del campo dinero_total
        
        $prestamo->save();
    
        // Puedes agregar cualquier lógica adicional que necesites aquí, como redireccionar a una página o mostrar un mensaje de éxito    
        return redirect()->back()->with('success', 'Préstamo creado exitosamente');
    }
    
    public function destroy(Prestamo $prestamo)
    {
        // Realizar la lógica de eliminación del cliente
        $prestamo->delete();
    
        // Redirigir a la página de registros con un mensaje de éxito
        return redirect()->back()->with('success', 'Cliente eliminado exitosamente');
    }
}
