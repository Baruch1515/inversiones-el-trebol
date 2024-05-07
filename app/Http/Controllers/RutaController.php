<?php

namespace App\Http\Controllers;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Models\Ruta;
use App\Models\Cliente;

class RutaController extends Controller
{
    public function index()
    {
        $rutas = Ruta::all();
    
        foreach ($rutas as $ruta) {
            // Obtener los préstamos asociados a esta ruta
            $prestamos = $ruta->prestamos;
    
            // Inicializar un array para almacenar los IDs de los clientes únicos
            $clientesUnicos = [];
    
            // Iterar sobre los préstamos y almacenar los IDs de los clientes únicos
            foreach ($prestamos as $prestamo) {
                $clientesUnicos[$prestamo->cliente_id] = true;
            }
    
            // Contar el número de clientes únicos vinculados a esta ruta
            $ruta->numeroClientes = count($clientesUnicos);
    
            // Calcular el monto total de dinero para esta ruta
                
    $ruta->montoTotal = $ruta->prestamos()->sum('dinero_total');

        }
    
        return view('rutas', compact('rutas'));
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);
    
        // Crear una nueva ruta
        $ruta = new Ruta();
        $ruta->nombre = $request->nombre;
        $ruta->save();
    
        // Redirigir con un mensaje de éxito
        return redirect()->back()->with('success', 'Ruta creada exitosamente');
    }
    

    public function editar($id)
    {
        $ruta = Ruta::findOrFail($id);
        return view('editar-ruta', compact('ruta'));
    }

    public function update(Request $request, $id)
    {
        // Validación de los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            // Otros campos de la ruta
        ]);
    
        // Elimina el campo _token de los datos del formulario
        $data = $request->except(['_token']);
    
        // Actualizar la ruta
        $ruta = Ruta::findOrFail($id);
        $ruta->update($data);
    
        return redirect('/rutas')->with('bienactualizada', 'Ruta actualizada exitosamente');
    }
    

    public function destroy($id)
    {
        $ruta = Ruta::findOrFail($id);
    
        // Verificar si hay préstamos activos en esta ruta
        if ($ruta->prestamos()->exists()) {
            return redirect('/rutas')->with('mal', 'No puede ser eliminada esta ruta tienes prestamos en el.');

        }
    
        // Si no hay préstamos activos, procede con la eliminación
        $ruta->delete();
    
        return redirect('/rutas')->with('bien', 'Ruta eliminada exitosamente');
    }

}
