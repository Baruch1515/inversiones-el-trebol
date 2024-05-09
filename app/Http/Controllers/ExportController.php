<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CajasExport;

class ExportController extends Controller
{
    public function export()
    {
        return Excel::download(new CajaExport, 'cajas.xlsx');
    }
}
