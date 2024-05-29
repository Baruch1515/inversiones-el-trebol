<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            @include('layouts/navigation')

        </div>
        <div class="col-md-9">
            @include('layouts/navigation')
            <br>
            <div class="col-md-12">
                <h3>Nuevo Prestamo</h3>
                <form action="{{ route('prestamos.store') }}" id="myForm" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="cliente">Cliente</label>
                        <input style="border-color:white; color:white;" type="text" id="busquedaCliente"
                            class="form-control" placeholder="Buscar cliente...">
                        <br>
                        <select name="cliente" id="cliente" class="form-control" required>
                            @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->id }}">{{ $cliente->nombre }} {{ $cliente->apellido }}
                                </option>
                            @endforeach
                        </select><br>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Monto</label>
                        <input style="border-color:white; color:white;" type="text" oninput="formatCurrency(this)"
                            name="monto" id="monto" class="form-control" required>
                    </div>
                    <br>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Cuotas </label>
                        <input style="border-color:white; color:white;" type="number" name="cuotas"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')" class="form-control" required>
                    </div>
                    <br>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Intereses</label>
                        <input style="border-color:white; color:white;" type="text" name="intereses" id="intereses"
                            class="form-control" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="cliente">Días de cobro</label><br>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="cobro[]" value="Lunes">
                            <label class="form-check-label">Lunes</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="cobro[]" value="Martes">
                            <label class="form-check-label">Martes</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="cobro[]" value="Miércoles">
                            <label class="form-check-label">Miércoles</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="cobro[]" value="Jueves">
                            <label class="form-check-label">Jueves</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="cobro[]" value="Viernes">
                            <label class="form-check-label">Viernes</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="cobro[]" value="Sábado">
                            <label class="form-check-label">Sábado</label>
                        </div>

                        <br>
                        <br>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Monto de la cuota</label>
                            <input style="border-color:white; color:white;" oninput="formatCurrency(this)"
                                type="text" name="monto_cuota" class="form-control" required>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="ruta">Ruta</label>
                            <select name="ruta" id="ruta" class="form-control" required>
                                <option value="">Seleccionar ruta</option>
                                @foreach ($rutas as $ruta)
                                    <option value="{{ $ruta->id }}">{{ $ruta->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>

                        <div class="form-group">
                            <label for="my-textarea">Nota</label>
                            <textarea style="border-color:white; color:white;" style="resize:none;" id="my-textarea" class="form-control"
                                name="nota" rows="3"></textarea>
                            <br>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="ganancia" id="ganancia" value="">
                        </div>

                        <input type="hidden" name="dinero_total" id="dinero_total" value="">


                        <button type="submit" class="btn btn-success">Guardar</button>
                        <button type="button" class="btn btn-warning" onclick="limpiarFormulario()">Limpiar</button>

                </form>
            </div>

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
                    }, 5000);
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
            <script>
                function calcularDineroTotal() {
                    // Obtener el valor del monto
                    var monto = parseFloat(
                        document.getElementById("monto").value.replace(",", "")
                    ); // Reemplaza la coma por nada para evitar errores al convertir a número

                    // Obtener el valor de los intereses en porcentaje
                    var interesesPorcentaje = parseFloat(
                        document.getElementById("intereses").value.replace(",", "")
                    ); // Reemplaza la coma por nada para evitar errores al convertir a número

                    // Calcular el monto de los intereses
                    var interesesMonto = (monto * interesesPorcentaje) / 100;

                    // Calcular el dinero total
                    var dineroTotal = monto + interesesMonto;

                    // Mostrar el dinero total en el campo correspondiente
                    document.getElementById("dinero_total").value = dineroTotal.toFixed(2); // Limitar a dos decimales
                }


                function formatCurrency(input) {
                    // Eliminar caracteres no numéricos
                    let value = input.value.replace(/[^0-9]/g, "");

                    // Dar formato al valor con un signo de dólar y puntos cada tres cifras
                    value = "$" + value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");

                    // Asignar el valor formateado de vuelta al campo de entrada
                    input.value = value;
                }


                // Función para filtrar los elementos del select
                function filtrarClientes() {
                    var input, filtro, select, options, option, i, txtValue;
                    input = document.getElementById('busquedaCliente');
                    filtro = input.value.toUpperCase();
                    select = document.getElementById('cliente');
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

                // Evento de entrada para activar la función de filtrado
                document.getElementById('busquedaCliente').addEventListener('input', filtrarClientes);
            </script>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

<style>
    .form-group {
        color: white;
        border-color: white;
    }

    .form-check-input {
        border-color: white;
    }
</style>
