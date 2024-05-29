<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/0c07597779.js" crossorigin="anonymous"></script>


    <link rel="stylesheet" href="{{ asset('js/main.css') }}">


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inversiones El trebol</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                @include('layouts/navigation')

            </div>
            <div class="col-md-9">
                <br>
                <h3>Registrar nueva cuota</h3>
                <form action="/cuotas" method="POST">
                    @csrf
                    <br>
                    <div class="form-group">
                        <h6 style="color:white;" for="prestamo">Seleccionar Cliente:</h6>
                        <input style="border-color:white; color:white;" type="text" id="busquedaCliente"
                            class="form-control" placeholder="Buscar cliente...">
                        <br>
                        <select name="prestamo" id="prestamo" class="form-control">
                            @foreach ($prestamos as $prestamo)
                                <option value="{{ $prestamo->id }}">{{ $prestamo->cliente->nombre }}
                                    {{ $prestamo->cliente->apellido }}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <div class="form-group">
                        <label style="color:white;" for="monto_cuota">Monto de la Cuota</label>
                        <input style="border-color:white; color:white;" type="text" name="monto_cuota"
                            id="monto_cuota" class="form-control" required oninput="formatCurrency(this)">
                    </div>
                    <br>
                    <div class="form-group">
                        <label style="color: white;" for="fecha">Fecha</label>
                        <input style="color:white; border-color:white;" type="date" name="fecha" id="fecha"
                            class="form-control" required>
                        <br>
                    </div>

                    <button type="submit" class="btn btn-primary">Agregar Cuota</button>
                </form>
                <br>
                @if (Session::has('success'))
                    <div id="floating-alert" class="alert alert-success alert-floating">
                        {{ Session::get('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <script>
                        // Obtener el elemento de la alerta flotante
                        var floatingAlert = document.getElementById('floating-alert');

                        // Mostrar la alerta flotante
                        floatingAlert.classList.add('show');

                        // Ocultar la alerta flotante después de 5 segundos
                        setTimeout(function() {
                            floatingAlert.classList.remove('show');
                        }, 3000);
                    </script>
                @endif
            </div>

        </div>
    </div>

    <script>
        function formatCurrency(input) {
            // Elimina el símbolo de dólar y los separadores de miles
            let value = input.value.replace(/[$,.]/g, '');

            // Formatea el valor con un signo de dólar y puntos cada tres cifras
            value = '$' + value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

            // Asigna el valor formateado de vuelta al campo de entrada
            input.value = value;
        }

        // Función para filtrar los elementos del select de préstamos
        function filtrarClientes() {
            var input, filtro, select, options, option, i, txtValue;
            input = document.getElementById('busquedaCliente');
            filtro = input.value.toUpperCase();
            select = document.getElementById('prestamo');
            options = select.getElementsByTagName('option');
            for (i = 0; i < options.length; i++) {
                option = options[i];
                txtValue = option.textContent || option.innerText;
                if (txtValue.toUpperCase().indexOf(filtro) > -1) {
                    option.style.display = "";
                } else {
                    option.style.display = "none";
                }
            }
        }

        // Evento de entrada para activar la función de filtrado de préstamos
        document.getElementById('busquedaCliente').addEventListener('input', filtrarClientes);
    </script>
    <br>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

<style>
    * {
        white: white;
    }
</style>

</html>
