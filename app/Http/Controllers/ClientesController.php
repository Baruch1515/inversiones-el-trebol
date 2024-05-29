<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Cliente;
use App\Models\Prestamo;

class ClientesController extends Controller
{
    public function index()
    {
        return view('nuevo-cliente');
    }
    public function search(Request $request)
    {
        $query = $request->input('query');
        $clientes = Cliente::where('nombre', 'LIKE', "%{$query}%")
            ->orWhere('apellido', 'LIKE', "%{$query}%")
            ->orWhere('telefono', 'LIKE', "%{$query}%")
            ->orWhere('barrio', 'LIKE', "%{$query}%")
            ->orWhere('direccion', 'LIKE', "%{$query}%")
            ->get();

        return response()->json($clientes);
    }


    public function clientes()
    {
        $clientes = Cliente::paginate(5); // Aplica paginate() antes de all()
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
        // Verificar si el cliente tiene préstamos pendientes
        $prestamosPendientes = Prestamo::where('cliente_id', $cliente->id)->count();
        if ($prestamosPendientes > 0) {
            // Si hay préstamos pendientes, redirige con un mensaje de error
            return redirect()->back()->with('error', 'No puedes eliminar a este cliente porque tiene préstamos pendientes.')->with('client_id', $cliente->id);

        }

        // Si no hay préstamos pendientes, procede con la eliminación del cliente
        $cliente->delete();

        // Redirige a la página de registros con un mensaje de éxito
        return redirect()->back()->with('success', 'Cliente eliminado exitosamente');
    }

}