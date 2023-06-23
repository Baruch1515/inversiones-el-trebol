<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Prestamo;

class PrestamosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $clientes = Cliente::all(); 
        return view("nuevo-prestamo", compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $prestamo = new Prestamo();
        $prestamo->cliente_id = $request->cliente;
        $prestamo->monto = str_replace(['$', ','], '', $request->monto);
        $prestamo->cuotas = $request->cuotas;
        $prestamo->intereses = $request->intereses;
        $prestamo->cobro = $request->cobro;
        $prestamo->monto_cuota = str_replace(['$', ','], '', $request->monto_cuota);
        // Eliminar el punto del monto

        $prestamo->save();
  
        // Puedes agregar cualquier lógica adicional que necesites aquí, como redireccionar a una página o mostrar un mensaje de éxito
    
        return redirect()->back()->with('success', 'Préstamo creado exitosamente');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
