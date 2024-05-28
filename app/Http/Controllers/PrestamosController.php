<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Prestamo;
use Illuminate\Support\Facades\DB;
use App\Models\Ruta;
use App\Models\Cuota;


class PrestamosController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();
        $rutas = Ruta::all();
        return view('nuevo-prestamo', compact('clientes', 'rutas'));
    }
    public function dashboard(Request $request)
    {
        $totalDinero = Prestamo::sum('dinero_total');
        $totalcaja = Cuota::sum('monto_cuota');
        $totalPrestamos = Prestamo::count(); // Agregar esta línea para obtener el número total de préstamos
        $totalClientes = Cliente::count(); // Agregar esta línea para obtener el número total de préstamos
        $totalGanancias = Prestamo::sum('ganancia'); // Agregar esta línea para obtener el número total de préstamos
        $horaActual = Carbon::now('America/Bogota');
        $diaCobro = $request->cobro;
        $rutas = Ruta::all();
        $nombreRuta = $request->nombre; // Cambiado de $ruta a $nombreRuta para mayor claridad
        $prestamosQuery = Prestamo::query()->with('ruta');

        // Verificar si se ha seleccionado un día de cobro
        if (!empty($diaCobro)) {
            $prestamosQuery->where('cobro', 'LIKE', "%$diaCobro%");
        }

        // Verificar si se ha seleccionado una ruta
        if (!empty($nombreRuta)) {
            // Filtrar los préstamos por el nombre de la ruta
            $prestamosQuery->whereHas('ruta', function ($query) use ($nombreRuta) {
                $query->where('nombre', $nombreRuta); // Asegúrate de utilizar la columna correcta que almacena el nombre de la ruta en la tabla Ruta
            });
        }

        // Lógica para buscar clientes
        $query = $request->input('query');

        // Obtener clientes que coincidan con la búsqueda
        $clientes = Cliente::where('nombre', 'like', '%' . $query . '%')
            ->orWhere('apellido', 'like', '%' . $query . '%')
            ->get();

        // Filtrar los préstamos por cliente si se ha realizado una búsqueda de cliente
        if (!empty($query) && !$clientes->isEmpty()) {
            $prestamosQuery->whereHas('cliente', function ($query) use ($clientes) {
                $query->whereIn('id', $clientes->pluck('id'));
            });
        }
        $today = Carbon::today('America/Bogota');
        $cuotasHoy = Cuota::whereDate('fecha', $today)->get();
        $sumaCuotasHoy = $cuotasHoy->sum('monto_cuota');

        // Obtener los préstamos paginados en lugar de obtener todos los resultados
        $prestamos = $prestamosQuery->paginate(5);

        return view('dashboard', compact('prestamos', 'diaCobro', 'clientes', 'query', 'rutas', 'totalDinero', 'totalcaja', 'sumaCuotasHoy', 'totalPrestamos', 'totalClientes', 'totalGanancias'));
    }


    public function store(Request $request)
    {
        // Crea el nuevo préstamo
        $prestamo = new Prestamo();
        $prestamo->cliente_id = $request->cliente;
        $prestamo->ruta_id = $request->ruta; // Asigna la ruta seleccionada al campo ruta_id
        $prestamo->monto = (int) str_replace(['$', '.'], '', $request->monto);
        $prestamo->cuotas = intval($request->cuotas);
        $prestamo->intereses = $request->intereses;
        $prestamo->nota = $request->nota;
        $prestamo->cobro = implode(', ', $request->cobro);
        $prestamo->monto_cuota = (float) str_replace(['$', '.'], '', $request->monto_cuota);

        // Calcula la ganancia como el porcentaje de intereses sobre el monto
        $prestamo->ganancia = ($prestamo->monto * $request->intereses) / 100;

        // Calcula el dinero total sumando el monto y la ganancia
        $prestamo->dinero_total = $prestamo->monto + $prestamo->ganancia;

        $prestamo->save();
        // Redirige con un mensaje de éxito
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
