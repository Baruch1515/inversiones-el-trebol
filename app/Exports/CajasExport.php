<?php
namespace App\Exports;

use App\Models\Caja;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CajaExport implements FromCollection, WithHeadings
{
    protected $cajas;

    public function __construct($cajas)
    {
        $this->cajas = $cajas;
    }

    public function collection()
    {
        return $this->cajas;
    }

    public function headings(): array
    {
        return [
            '#',
            'Fecha',
            'Dinero Global',
            'Dinero en Cartera',
            'Total Clientes',
            'Total de Prestamos',
            'Ganancias',
            'Dinero Recogido',
        ];
    }
}
