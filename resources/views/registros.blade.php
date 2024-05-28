<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráfico de Dinero en Cartera</title>
    <!-- Incluir la biblioteca Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/0c07597779.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>

<body>
    @include('layouts/navigation')
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h3>Registro de Caja</h3>
                <br>

                <form action="{{ route('filtrar-registros') }}" method="GET" class="row g-3">
                    <div class="col-auto">
                        <div class="col-auto">
                            <label for="staticEmail2" class="visually-hidden">Email</label>
                            <input type="text" readonly class="form-control-plaintext" id="staticEmail2"
                                value="Fecha de Inicio:">
                        </div>
                        <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control">
                    </div>
                    <div class="col-auto">
                        <label for="fecha_fin">Fecha de fin:</label>
                        <input type="date" id="fecha_fin" name="fecha_fin" class="form-control">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </div>
                </form>
                <br>

                <table id="tabla" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Fecha</th>
                            <th>Dinero Global</th>
                            <th>Dinero en Cartera</th>
                            <th>Total Clientes</th>
                            <th>Total de prestamos</th>
                            <th>Ganancias</th>
                            <th>Dinero Recogido</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cajas as $caja)
                            <tr>
                                <td>{{ $caja->id }}</td>
                                <td>{{ $caja->created_at }}</td>
                                <td><b>${{ number_format($caja->dinero_global, 0, '.', '.') }}</b></td>
                                <td><b>${{ number_format($caja->dineroCartera, 0, '.', '.') }}</b></td>
                                <td>{{ $caja->total_clientes }}</td>
                                <td>{{ $caja->total_prestamos }}</td>
                                <td><b>${{ number_format($caja->total_ganancias, 0, '.', '.') }}</b></td>
                                <td><b>${{ number_format($caja->sumaCuotasHoy, 0, '.', '.') }}</b></td>
                                <td>

                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $caja->id }}"">
                                        Eliminar <i class="fas fa-trash-alt"></i>
                                    </button>
                                    <!-- Modal ELIMINAR REGISTRO -->
                                    <div class="modal fade" id="deleteModal{{ $caja->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">¿Estas seguro de
                                                        eliminar este registro?</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('borrar-registro', $caja->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">No</button>
                                                            <button type="submit" class="btn btn-danger">Si</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    {{ $cajas->links() }}
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!-- Resto del contenido de tu tabla -->
                <a href="{{ route('exportar', ['fecha_inicio' => request('fecha_inicio'), 'fecha_fin' => request('fecha_fin')]) }}"
                    class="btn btn-success">Descargar Excel <i class="fa-solid fa-floppy-disk"></i></a>

            </div>
        </div>
    </div>


</body>

</html>
