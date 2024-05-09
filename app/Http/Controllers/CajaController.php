<?php

namespace App\Http\Controllers;
use App\Models\Caja;
use App\Models\Prestamo;
use App\Models\Cliente;
use App\Models\Cuota;
use App\Models\Ruta;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Carbon\Carbon;

use App\Exports\CajaExport;
use Maatwebsite\Excel\Facades\Excel;
class CajaController extends Controller
{
    function formatearNumero($numero)
    {
        return sprintf('%08.3f', $numero);
    }

    public function graficas()
    {
        // Obtener los datos de la tabla prestamos
        $prestamos = Prestamo::all();

        // Inicializar un arreglo para almacenar los montos prestados por mes
        $montosPorMes = [];

        // Recorrer los prestamos y agrupar los montos por mes
        foreach ($prestamos as $prestamo) {
            $fechaPrestamo = Carbon::parse($prestamo->created_at);
            $mes = $fechaPrestamo->format('m');
            $ano = $fechaPrestamo->format('Y');
            $monto = $prestamo->monto;

            // Crear una clave única para cada mes y año
            $clave = $ano . '-' . $mes;

            // Agregar el monto al arreglo correspondiente al mes y año
            if (array_key_exists($clave, $montosPorMes)) {
                $montosPorMes[$clave] += $monto;
            } else {
                $montosPorMes[$clave] = $monto;
            }
        }

        // Obtener los meses y años distintos de los prestamos
        $mesesAnos = array_keys($montosPorMes);

        // Ordenar los meses y años de forma ascendente
        sort($mesesAnos);

        // Inicializar arreglos para las etiquetas y los montos
        $labels = [];
        $montos = [];

        // Iterar sobre los meses y años para construir las etiquetas y los montos
        foreach ($mesesAnos as $mesAno) {
            $fecha = Carbon::createFromFormat('Y-m', $mesAno);
            $labels[] = $fecha->format('F Y');
            $montos[] = $montosPorMes[$mesAno];
        }

        // Obtener el dinero total prestado en todos los meses
        $dineroGlobal = array_sum($montos);

        // Obtener la fecha y hora actual en Colombia
        $horaActual = Carbon::now('America/Bogota');

        // Obtener el dinero recogido hoy
        $today = Carbon::today('America/Bogota');
        $cuotasHoy = Cuota::whereDate('fecha', $today)->get();
        $sumaCuotasHoy = $cuotasHoy->sum('monto_cuota');

        $rutas = Ruta::all();

        // Inicializar arreglos para almacenar los nombres de las rutas y los montos totales por ruta
        $nombresRutas = [];
        $montosPorRuta = [];
        $coloresBarras = [];

        // Definir un array de colores para las barras
        $colores = [
            'rgba(255, 99, 132, 0.5)',
            'rgba(54, 162, 235, 0.5)',
            'rgba(255, 206, 86, 0.5)',
            // Agrega más colores según sea necesario
        ];

        // Recorrer las rutas y calcular los montos totales por ruta
        foreach ($rutas as $index => $ruta) {
            $nombresRutas[] = $ruta->nombre; // Suponiendo que tienes un campo 'nombre' en tu modelo de ruta
            $montosPorRuta[] = $ruta->prestamos()->sum('monto');
            // Asignar un color diferente a cada barra, asegurándose de que se repitan los colores si hay más barras que colores definidos
            $coloresBarras[] = $colores[$index % count($colores)];
        }


        $registrosDinero = Caja::all();

        // Inicializar arreglos para almacenar las fechas y los montos de dinero global
        $fechas = [];
        $dineroGlobal = [];
    
        // Iterar sobre los registros de dinero para obtener las fechas y los montos
        foreach ($registrosDinero as $registro) {
            $fechas[] = $registro->created_at; // Suponiendo que el modelo tiene un atributo 'fecha' que almacena la fecha del registro
            $dineroGlobal[] = $registro->dinero_global; // Suponiendo que el modelo tiene un atributo 'dinero_global' que almacena el monto de dinero global
        }
    

        // Pasar los datos a la vista
        return view('graficas', compact('fechas', 'dineroGlobal','sumaCuotasHoy', 'labels', 'montos', 'nombresRutas', 'montosPorRuta', 'coloresBarras', 'dineroGlobal'));
    }

    public function index()
    {
        $totalDinero = Prestamo::sum('dinero_total');
        $totalcaja = Cuota::sum('monto_cuota');
        $totalPrestamos = Prestamo::count(); // Agregar esta línea para obtener el número total de préstamos
        $totalClientes = Cliente::count(); // Agregar esta línea para obtener el número total de préstamos
        $totalGanancias = Prestamo::sum('ganancia'); // Agregar esta línea para obtener el número total de préstamos
        $horaActual = Carbon::now('America/Bogota');

        // Obtener el dinero recogido hoy
        $today = Carbon::today('America/Bogota');
        $cuotasHoy = Cuota::whereDate('fecha', $today)->get();
        $sumaCuotasHoy = $cuotasHoy->sum('monto_cuota');

        return view('caja', compact('totalDinero', 'totalcaja', 'sumaCuotasHoy', 'totalPrestamos', 'totalClientes', 'totalGanancias')); // Incluir la variable $totalPrestamos en la vista
    }

    public function registros()
    {
        $cajas = Caja::orderBy('id', 'desc')->paginate(10); // Cambia el número 10 por la cantidad de registros que deseas mostrar por página

        return view('registros', compact('cajas'));
    }

    public function filtrarRegistros(Request $request)
    {
        $fechaInicio = $request->input('fecha_inicio');
        $fechaFin = $request->input('fecha_fin');

        // Agrega un día a la fecha de fin para incluir registros hasta el final del día
        $fechaFin = date('Y-m-d', strtotime($fechaFin . ' +1 day'));

        // Verifica si se han proporcionado fechas de inicio y fin
        if ($fechaInicio && $fechaFin) {
            // Filtra los registros dentro del rango de fechas
            $cajas = Caja::whereBetween('created_at', [$fechaInicio, $fechaFin])
                ->orderBy('id', 'desc')
                ->paginate(10);
        } else {
            // Si no se proporcionan fechas de inicio y fin, muestra todos los registros
            $cajas = Caja::orderBy('id', 'desc')->paginate(10);
        }

        return view('registros', compact('cajas'));
    }

    public function exportarExcel(Request $request)
    {
        // Obtener las fechas de inicio y fin de la solicitud
        $fechaInicio = $request->input('fecha_inicio');
        $fechaFin = $request->input('fecha_fin');

        // Filtrar los registros basados en las fechas
        $cajas = Caja::whereBetween('created_at', [$fechaInicio, $fechaFin])->get();

        // Exportar los datos a un archivo de Excel utilizando la clase de exportación
        return Excel::download(new CajaExport($cajas), 'cajas.xlsx');
    }

    public function borrarRegistro($id)
    {
        $caja = Caja::findOrFail($id);
        $caja->delete();

        return redirect()->back()->with('success', 'Registro eliminado correctamente.');
    }

    public function guardarRegistroDinero(Request $request)
    {
        // Guarda los datos en la tabla "registros_dinero"
        $registroDinero = new Caja();
        $registroDinero->dinero_global = $request->dineroGlobal;
        //$registroDinero->dineroCartera = str_replace(['$', ','], '', $dineroCartera);
        $registroDinero->dineroCartera = str_replace(['$', '.'], '', $request->dineroCartera);

        $registroDinero->total_clientes = $request->totalClientes;
        $registroDinero->total_prestamos = $request->totalPrestamos;
        $registroDinero->total_ganancias = $request->totalGanancias;
        $registroDinero->sumaCuotasHoy = $request->sumaCuotasHoy;

        $registroDinero->save();

        return redirect()->back()->with('success', 'Registro de dinero guardado exitosamente.');
    }
}
