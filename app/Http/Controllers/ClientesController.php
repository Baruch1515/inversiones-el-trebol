<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Cliente;

class ClientesController extends Controller
{
    public function index()
    {
        return view('nuevo-cliente');
    }

    public function clientes()
    {
        $clientes = Cliente::all(); // Obtén todos los datos de TuModelo
        return view('clientes', compact('clientes'));
    }
    
    public function guardar(Request $request)
    {
        $cliente = new Cliente();
        $cliente->nombre = $request->nombre;
        $cliente->apellido = $request->apellido;
        $cliente->telefono = $request->telefono;
        $cliente->barrio = $request->barrio;
        $cliente->direccion = $request->direccion;
        $cliente->save();

        // Puedes agregar cualquier lógica adicional aquí, como redireccionar a una página de éxito o mostrar un mensaje de confirmación
        Session::flash('success', 'Cliente creado exitosamente');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        // Validar los datos del formulario de edición
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'telefono' => 'required',
            'barrio' => 'required',
            'direccion' => 'required',
        ]);
    
        // Obtener el cliente a editar
        $cliente = Cliente::findOrFail($id);
    
        // Actualizar los datos del cliente con los valores del formulario
        $cliente->nombre = $request->input('nombre');
        $cliente->apellido = $request->input('apellido');
        $cliente->telefono = $request->input('telefono');
        $cliente->barrio = $request->input('barrio');
        $cliente->direccion = $request->input('direccion');
    
        // Guardar los cambios en la base de datos
        $cliente->save();
    
        // Redireccionar a la página de registros con un mensaje de éxito
        return redirect()->back();
    }
    public function destroy(Cliente $cliente)
    {
        // Realizar la lógica de eliminación del cliente
        $cliente->delete();
    
        // Redirigir a la página de registros con un mensaje de éxito
        return redirect()->back()->with('success', 'Cliente eliminado exitosamente');
    }
    
}
