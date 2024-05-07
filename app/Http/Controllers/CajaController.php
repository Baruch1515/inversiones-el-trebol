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
class CajaController extends Controller
{

    function formatearNumero($numero)
    {
        return sprintf("%08.3f", $numero);
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
    
        // Obtener el dinero recogido hoy
        $today = Carbon::today();
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
    
        // Pasar los datos a la vista
        return view('graficas', compact('sumaCuotasHoy', 'labels', 'montos', 'nombresRutas', 'montosPorRuta','coloresBarras'));
    }
    
    



    public function index()
    {
        $totalDinero = Prestamo::sum('dinero_total');
        $totalcaja = Cuota::sum('monto_cuota');
        $totalPrestamos = Prestamo::count(); // Agregar esta línea para obtener el número total de préstamos
        $totalClientes = Cliente::count(); // Agregar esta línea para obtener el número total de préstamos
        $totalGanancias = Prestamo::sum('ganancia'); // Agregar esta línea para obtener el número total de préstamos

        return view('caja', compact('totalDinero', 'totalcaja', 'totalPrestamos', 'totalClientes', 'totalGanancias')); // Incluir la variable $totalPrestamos en la vista
    }

    public function registros()
    {
        $cajas = Caja::all(); // Obtén todos los datos de TuModelo

        return view('registros', compact('cajas'));
    }

    public function guardarRegistroDinero(Request $request)
    {
        $dineroGlobal = $request->input('dineroGlobal');
        $dineroCartera = str_replace(['$', '.'], '', $request->input('dineroCartera'));
        $totalClientes = $request->input('totalClientes');
        $totalPrestamos = $request->input('totalPrestamos');
        $totalGanancias = $request->input('totalGanancias');

        // Guarda los datos en la tabla "registros_dinero"
        $registroDinero = new Caja();
        $registroDinero->dinero_global = $dineroGlobal;
        $registroDinero->dineroCartera = str_replace(['$', ','], '', $request->dineroCartera);

        $registroDinero->total_clientes = $totalClientes;
        $registroDinero->total_prestamos = $totalPrestamos;
        $registroDinero->total_ganancias = $totalGanancias;
        $registroDinero->save();

        return redirect()->back()->with('success', 'Registro de dinero guardado exitosamente.');
    }
}
