<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/0c07597779.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inversiones El trebol</title>
    <style>
        .table-dark-custom {
            background-color: black;
            color: white;
        }

        .table-dark-custom th,
        .table-dark-custom td {
            color: white;
        }
    </style>
</head>

<body>
    @include('layouts/navigation')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                @include('layouts/navigation')
            </div>
            <div class="col-md-9">

                <!-- Sale & Revenue Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="row g-4">
                        <div class="col-sm-6 col-xl-3">
                            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                                <i class="fa-solid fa-earth-americas fa-3x text-primary"></i>
                                <div class="ms-3">
                                    <p class="mb-2">Dinero Global</p>
                                    <h6 class="mb-0">${{ number_format($totalDinero, 0, '.', '.') }}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3">
                            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                                <i class="fa-solid fa-wallet fa-3x text-primary"></i>
                                <div class="ms-3">
                                    <p class="mb-2">Dinero Caja</p>
                                    <h6 class="mb-0">${{ number_format($totalcaja, 0, '.', '.') }}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3">
                            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                                <i class="fa-solid fa-hand-holding-dollar fa-3x text-primary"></i>
                                <div class="ms-3">
                                    <p class="mb-2">Prestamos</p>
                                    <h6 class="mb-0">{{ $totalPrestamos }}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3">
                            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                                <i class="fa fa-chart-pie fa-3x text-primary"></i>
                                <div class="ms-3">
                                    <p class="mb-2">Recogido Hoy</p>
                                    <h6 class="mb-0">${{ number_format($sumaCuotasHoy, 0, '.', '.') }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Sale & Revenue End -->
                <br>
                <div class="row mb-3 align-items-end">
                    <div class="col-md-3">
                        <form action="{{ route('dashboard') }}" method="GET" class="row g-3">
                            <div class="col-12">
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
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-3">
                        <form action="{{ route('dashboard') }}" method="GET">
                            <button type="submit" class="btn btn-secondary w-100">Mostrar todos los
                                prestamos</button>
                        </form>
                    </div>
                    <div class="col-md-3">
                        <form action="{{ route('dashboard') }}" method="GET" class="row g-3">
                            <div class="col-12">
                                <select name="nombre" id="nombre" class="form-control" required>
                                    <option value="" selected>Seleccione una ruta</option>
                                    @foreach ($rutas as $ruta)
                                        <option value="{{ $ruta->nombre }}">{{ $ruta->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-3">
                        <form method="GET" action="{{ route('dashboard') }}" class="row g-3">
                            <div class="col-12">
                                <input style=" color:white; border-color: white;" class="form-control" type="text"
                                    name="query" placeholder="Buscar clientes...">
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-success w-100">Buscar<i
                                        class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @if (!empty($clientes) || !empty($query))
                            <!-- Tabla de resultados de búsqueda -->
                            <table class="table table-sm table-dark-custom">
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
                                                    Eliminar <i class="fa-solid fa-trash"></i>
                                                </button>
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#verModal{{ $prestamo->id }}">
                                                    Ver <i class="fa-solid fa-eye"></i>
                                                </button>

                                                <div class="modal fade" id="deleteModal{{ $prestamo->id }}"
                                                    tabindex="-1" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 style="color:black;" class="modal-title"
                                                                    id="exampleModalLabel">
                                                                    Confirmar Eliminación</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p style="color: black;">¿Estás seguro de que deseas
                                                                    eliminar este
                                                                    registro?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form
                                                                    action="{{ route('prestamo.destroy', $prestamo->id) }}"
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

                                                <div class="modal fade" id="verModal{{ $prestamo->id }}"
                                                    tabindex="-1" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 style="color:black;" class="modal-title"
                                                                    id="exampleModalLabel">
                                                                    Prestamo</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div style="color:black;" class="modal-body">
                                                                <p><b>Nombre:</b> {{ $prestamo->cliente->nombre }}
                                                                    {{ $prestamo->cliente->apellido }}
                                                                </p>
                                                                <p><b>Cuotas:</b> {{ $prestamo->cuotas }}</p>
                                                                <p><b>Prestamo:</b>
                                                                    ${{ number_format($prestamo->monto, 0, ',', '.') }}
                                                                </p>
                                                                <p><b>Intereses:</b> {{ $prestamo->intereses }}%</p>
                                                                <p><b>ganancia:</b>
                                                                    ${{ number_format($prestamo->ganancia, 0, ',', '.') }}
                                                                </p>
                                                                <p><b>Cuota:</b>
                                                                    ${{ number_format($prestamo->monto_cuota, 0, ',', '.') }}
                                                                </p>
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
                @if ($prestamos->hasPages())
                    <ul class="pagination">
                        {{-- Flecha Izquierda --}}
                        @if ($prestamos->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link" aria-hidden="true"><i
                                        class="fa-solid fa-left-long"></i></span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $prestamos->previousPageUrl() }}" rel="prev"
                                    aria-label="@lang('pagination.previous')">
                                    <span aria-hidden="true"><i class="fa-solid fa-left-long"></i></span>
                                </a>
                            </li>
                        @endif

                        {{-- Flecha Derecha --}}
                        @if ($prestamos->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $prestamos->nextPageUrl() }}" rel="next"
                                    aria-label="@lang('pagination.next')">
                                    <span aria-hidden="true"><i class="fa-solid fa-right-long"></i></span>
                                </a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link" aria-hidden="true"><i
                                        class="fa-solid fa-right-long"></i></span>
                            </li>
                        @endif
                    </ul>
                @endif
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
