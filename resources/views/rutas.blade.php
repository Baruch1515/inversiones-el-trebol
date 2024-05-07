<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rutas</title>
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="https://kit.fontawesome.com/0c07597779.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</head>

<body>
    @include('layouts/navigation')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4">

                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#nuevaRutaModal">
                            Nueva ruta
                        </button>

                        <div class="modal fade" id="nuevaRutaModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Nueva Ruta</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('rutas.store') }}" method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="nombre" class="form-label">Nombre de la Ruta</label>
                                                <input type="text" class="form-control" id="nombre" name="nombre"
                                                    required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <br><br>
                    <div class="col-md-4">
                    </div>
                </div>
                <table class="table table-bordered table-hover">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    Nombre
                                </th>
                                <th>
                                    Numero de clientes
                                </th>
                                <th>
                                    Cobro
                                </th>
                                <th>
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rutas as $ruta)
                                <tr class="table">
                                    <td>{{ $ruta->id }}</td>
                                    <td>{{ $ruta->nombre }}</td>
                                    <td>{{ $ruta->numeroClientes }}</td>
                                    <td>${{ number_format($ruta->montoTotal, 0, ',', '.') }}</td>
                                    <td>
                                        <!-- Botón para editar ruta -->
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
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
                                                <h5 class="modal-title" id="exampleModalLabel">Editar Ruta</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Aquí coloca el formulario de edición -->
                                                <form action="{{ route('rutas.update', $ruta->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <label for="nombre" class="form-label">Nuevo Nombre</label>
                                                        <input type="text" class="form-control" id="nombre"
                                                            name="nombre" value="{{ $ruta->nombre }}">
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
            </div>
        </div>
    </div>
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
        <style>
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
        <style>
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
        <style>
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
    @endif




</body>

</html>
