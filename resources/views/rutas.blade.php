<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .table-dark-custom {
            color: white;
            background-color: grey;
            border: 1px solid white;
        }

        .table-dark-custom th,
        .table-dark-custom td {
            border: 1px solid white;
        }

        .alert-floating {
            position: fixed;
            top: 10px;
            right: 10px;
            z-index: 9999;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }

        .alert-floating.show {
            opacity: 1;
        }
    </style>
    <title>Rutas</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                @include('layouts/navigation')
            </div>
            <div class="col-md-9">
                <br>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#nuevaRutaModal">
                    Nueva ruta
                </button>
                <br><br>
                <div class="modal fade" id="nuevaRutaModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 style="color:black;" class="modal-title" id="exampleModalLabel">Nueva Ruta</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('rutas.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label style="color:black;" for="nombre" class="form-label">Nombre de la
                                            Ruta</label>
                                        <input style="background:white; border-color:black; color:black;" type="text"
                                            class="form-control" id="nombre" name="nombre" required>
                                    </div>
                                    <button style="background-color: rgb(57, 57, 213);" type="submit"
                                        class="btn btn-primary">Guardar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <table class="table table-sm table-dark-custom">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Número de clientes</th>
                            <th>Cobro</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rutas as $ruta)
                            <tr>
                                <td>{{ $ruta->id }}</td>
                                <td>{{ $ruta->nombre }}</td>
                                <td>{{ $ruta->numeroClientes }}</td>
                                <td>${{ number_format($ruta->montoTotal, 0, ',', '.') }}</td>
                                <td>
                                    <!-- Botón para editar ruta -->
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#editarModal{{ $ruta->id }}">
                                        Editar
                                    </button>

                                    <!-- Formulario para eliminar ruta -->
                                    <form action="{{ route('rutas.destroy', $ruta->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <!-- Modal de edición -->
                            <div class="modal fade" id="editarModal{{ $ruta->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="color:black;" class="modal-title" id="exampleModalLabel">Editar
                                                Ruta</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Aquí coloca el formulario de edición -->
                                            <form action="{{ route('rutas.update', $ruta->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <label style="color:black;" for="nombre" class="form-label">Nuevo
                                                        Nombre</label>
                                                    <input style="background-color: white; color:black;" type="text"
                                                        class="form-control" id="nombre" name="nombre"
                                                        value="{{ $ruta->nombre }}">
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>

                @if (Session::has('bienactualizada'))
                    <div id="floating-alert" class="alert alert-success alert-floating">
                        {{ Session::get('bienactualizada') }}
                    </div>
                    <script>
                        // Obtener el elemento de la alerta flotante
                        var floatingAlert = document.getElementById('floating-alert');
                        // Mostrar la alerta flotante
                        floatingAlert.classList.add('show');
                        // Ocultar la alerta flotante después de 5 segundos
                        setTimeout(function() {
                            floatingAlert.classList.remove('show');
                        }, 3500);
                    </script>
                @endif

                @if (Session::has('bien'))
                    <div id="floating-alert" class="alert alert-success alert-floating">
                        {{ Session::get('bien') }}
                    </div>
                    <script>
                        // Obtener el elemento de la alerta flotante
                        var floatingAlert = document.getElementById('floating-alert');
                        // Mostrar la alerta flotante
                        floatingAlert.classList.add('show');
                        // Ocultar la alerta flotante después de 5 segundos
                        setTimeout(function() {
                            floatingAlert.classList.remove('show');
                        }, 3500);
                    </script>
                @endif

                @if (Session::has('mal'))
                    <div id="floating-alert" class="alert alert-danger alert-floating">
                        {{ Session::get('mal') }}
                    </div>
                    <script>
                        // Obtener el elemento de la alerta flotante
                        var floatingAlert = document.getElementById('floating-alert');
                        // Mostrar la alerta flotante
                        floatingAlert.classList.add('show');
                        // Ocultar la alerta flotante después de 5 segundos
                        setTimeout(function() {
                            floatingAlert.classList.remove('show');
                        }, 3500);
                    </script>
                @endif
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
