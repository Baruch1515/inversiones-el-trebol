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
<div class="container-fluid">
	<div class="row">
        @include("layouts/navigation")
        <br>
    <br>
        <h3>Nueva Cuota</h3>
		<div class="col-md-12">
<form action="/cuotas" method="POST">
        @csrf
        <div class="form-group">
        <label for="prestamo">Seleccionar Cliente:</label>
        <select name="prestamo" id="prestamo" class="form-control">
            @foreach ($prestamos as $prestamo)
                <option value="{{ $prestamo->id }}">{{ $prestamo->cliente->nombre }} {{ $prestamo->cliente->apellido }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
    <label for="monto_cuota">Monto de la Cuota</label>
    <input type="text" name="monto_cuota" id="monto_cuota" class="form-control" required oninput="formatCurrency(this)">
</div>

    <div class="form-group">
        <label for="fecha">Fecha</label>
        <input type="date" name="fecha" id="fecha" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Agregar Cuota</button>
</form>
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
    </script>
    
<br>
@if(Session::has('success'))
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
        setTimeout(function(){
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
</body>
</html>
