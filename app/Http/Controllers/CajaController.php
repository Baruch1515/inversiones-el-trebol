<?php

namespace App\Http\Controllers;
use App\Models\Caja;
use App\Models\Prestamo;
use App\Models\Cliente;
use App\Models\Cuota;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class CajaController extends Controller
{
    public function index()
    {
        $totalDinero = Prestamo::sum('dinero_total');
        $totalcaja = Cuota::sum('monto_cuota');
        $totalPrestamos = Prestamo::count(); // Agregar esta línea para obtener el número total de préstamos
        $totalClientes = Cliente::count(); // Agregar esta línea para obtener el número total de préstamos
        $totalGanancias = Prestamo::sum('ganancia'); // Agregar esta línea para obtener el número total de préstamos
    
        return view("caja", compact("totalDinero", "totalcaja", "totalPrestamos","totalClientes","totalGanancias")); // Incluir la variable $totalPrestamos en la vista
    }
    
    public function registros(){
        $cajas = Caja::all(); // Obtén todos los datos de TuModelo
        return view("registros",compact("cajas"));
    }

}
