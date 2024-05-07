<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://kit.fontawesome.com/0c07597779.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inversiones El trebol</title>
    <script src="{{ asset('js/dashboard.js') }}"></script>
</head>

<body>
    @include('layouts/navigation')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4">
                            <form action="{{ route('dashboard') }}" method="GET" class="row g-3">
                                <div class="col-auto">
                                    <label for="cobro" class="visually-hidden">Día de cobro</label>
                                </div>
                                <div class="col-auto">
                                    <select name="cobro" id="cobro" class="form-control" required>
                                        <option value="" selected>Seleccione un día</option>
                                        <option value="Lunes">Lunes</option>
                                        <option value="Martes">Martes</option>
                                        <option value="Miércoles">Miércoles</option>
                                        <option value="Jueves">Jueves</option>
                                        <option value="Viernes">Viernes</option>
                                        <option value="Sábado">Sábado</option>
                                        <option value="Domingo">Domingo</option>
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary">Filtrar</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <form action="{{ route('dashboard') }}" method="GET">
                                <div>
                                    <button type="submit" class="btn btn-secondary">Mostrar todos los
                                        prestamos</button>
                                </div>

                            </form>
                        </div>
                        <div class="col-md-4">
                            <form class="row g-3">
                                <div class="col-auto">
                                    <form method="GET" action="{{ route('dashboard') }}">
                                        <input class="form-control" type="text" name="query"
                                            placeholder="Buscar clientes...">
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-success"><i
                                            class="fa-solid fa-magnifying-glass"></i></button>
                                </div>
                            </form>
                            <br>
                        </div>
                    </div>
                </div>
                <!-- Mostrar resultados de búsqueda -->
                @if (!empty($clientes) || !empty($query))
                    <!-- Tabla de resultados de búsqueda -->
                    <table class="table table-bordered table-hover table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Cliente</th>
                                <th>Deuda</th>
                                <th>Día de cobro</th>
                                <th>Ruta</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($prestamos as $prestamo)
                                <tr>
                                    <td>{{ $prestamo->id }}</td>
                                    <td>{{ $prestamo->cliente->nombre }}</td>
                                    <td>${{ number_format($prestamo->dinero_total, 0, ',', '.') }}</td>
                                    <td>{{ $prestamo->cobro }}</td>
                                    <td>{{ $prestamo->ruta->nombre }}</td>
                                    <td>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $prestamo->id }}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>								  
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#verModal{{ $prestamo->id }}">
                                            <i class="fa-solid fa-eye"></i>
                                    </button>
										
                                        <div class="modal fade" id="deleteModal{{ $prestamo->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            Confirmar Eliminación</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>¿Estás seguro de que deseas eliminar este
                                                            registro?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="{{ route('prestamo.destroy', $prestamo->id) }}"
                                                            method="POST" style="display: inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-danger">Eliminar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal fade" id="verModal{{ $prestamo->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            Prestamo</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><b>Nombre:</b> {{ $prestamo->cliente->nombre }} {{ $prestamo->cliente->apellido }}
                                                        </p>
                                                        <p><b>Cuotas:</b> {{ $prestamo->cuotas }}</p>
                                                        <p><b>Prestamo:</b> ${{ number_format($prestamo->monto, 0, ',', '.') }}</p>
                                                        <p><b>Intereses:</b> {{ $prestamo->intereses }}%</p>
                                                        <p><b>ganancia:</b> ${{ number_format($prestamo->ganancia, 0, ',', '.') }}</p>
                                                        <p><b>Cuota:</b> ${{ number_format($prestamo->monto_cuota, 0, ',', '.') }}</p>
                                                        <p><b>Direccion:</b>
                                                            {{ $prestamo->cliente->direccion }}</p>
                                                        <p><b>Fecha de inicio:</b>
                                                            {{ $prestamo->created_at }}</p>
                                                        <p><b>Nota:</b> {{ $prestamo->nota }}</p>
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
                @endif
            </div>
        </div>
    </div>
</body>

</html>
