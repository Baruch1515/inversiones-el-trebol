<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/0c07597779.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inversiones El trebol</title>
</head>

<body>
    @include("layouts/navigation")
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h3>
                    Clientes
                </h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>
                                #
                            </th>
                            <th>
                                Nombre
                            </th>
                            <th>
                                Apellido
                            </th>
                            <th>
                                Telefono
                            </th>
                            <th>
                                Barrio
                            </th>
                            <th>
                                Dirección
                            </th>
                            <th>
                                Acciones
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->id }}</td>
                            <td>{{ $cliente->nombre }}</td>
                            <td>{{ $cliente->apellido }}</td>
                            <td>{{ $cliente->telefono }}</td>
                            <td>{{ $cliente->barrio }}</td>
                            <td>{{ $cliente->direccion }}</td>
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $cliente->id }}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $cliente->id }}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="deleteModal{{ $cliente->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Confirmar Eliminación</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>¿Estás seguro de que deseas eliminar este registro?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" style="display: inline-block;"> @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if(session('error'))
    <script>
        // Muestra la alerta utilizando JavaScript
        alert("{{ session('error') }}");
        // Redirige nuevamente a la vista de clientes si es necesario
    </script>
@endif
                                <div class="modal fade" id="editModal{{ $cliente->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('clientes.update', $cliente->id) }}" id="myForm" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Nombre </label>
                                                        <input value="{{$cliente->nombre}}" type="text" name="nombre" class="form-control">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Apellido </label>
                                                        <input value="{{$cliente->apellido}}" type="text" name="apellido" class="form-control">
                                                    </div>


                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Telefono</label>
                                                        <input value="{{$cliente->telefono}}" type="text" name="telefono" class="form-control" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                                                    </div>


                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Barrio </label>
                                                        <input value="{{$cliente->barrio}}" type="text" name="barrio" class="form-control">
                                                    </div>


                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Direccion </label>
                                                        <input value="{{$cliente->direccion}}" type="text" name="direccion" class="form-control">
                                                    </div>

                                                    <button type="submit" class="btn btn-success">Guardar</button>
                                                    <button type="button" class="btn btn-warning" onclick="limpiarFormulario()">Limpiar</button>

                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>



                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>

</html>