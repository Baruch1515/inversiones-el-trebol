<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inversiones El trebol</title>
    <script src="https://kit.fontawesome.com/0c07597779.js" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                @include('layouts/navigation')

            </div>
            <div class="col-md-9">
                <h3>Registro de Cuotas</h3>
                <form class="row g-3" action="{{ route('ver.cuotas') }}" method="GET">

                    <label for="clienteSelect">Seleccionar Cliente:</label>
                    <div class="col-auto">
                        <select class="form-control" id="clienteSelect" name="cliente_id">
                            @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->id }}">{{ $cliente->nombre }} {{ $cliente->apellido }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Mostrar Cuotas</button>
                    </div>
                </form>
                <br>
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Cuota</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cuotas as $cuota)
                            <tr>
                                <td>{{ $cuota->id }}</td>
                                <td>{{ $cuota->prestamo->cliente->nombre }} {{ $cuota->prestamo->cliente->apellido }}
                                </td>
                                <td>${{ number_format($cuota->monto_cuota, 0, ',', '.') }}</td>
                                <td>{{ $cuota->fecha }}</td>
                                <td>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $cuota->id }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="deleteModal{{ $cuota->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="color: black;" class="modal-title"
                                                        id="exampleModalLabel">Confirmar Eliminación
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p style="color: black;">¿Estás seguro de que deseas eliminar este
                                                        registro?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('cuotas.destroy', $cuota->id) }}"
                                                        method="POST" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                                    </form>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    </script>
    <style>
        .table th,
        .table td {
            color: white;
        }
    </style>
</body>

</html>
