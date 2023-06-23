<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"><script src="https://kit.fontawesome.com/0c07597779.js" crossorigin="anonymous"></script>
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
		<div class="col-md-12">
            <h3>Nuevo Prestamo</h3>
            <form action="{{ route('prestamos.store') }}" id="myForm" method="POST">
                @csrf
            <div class="form-group">
            <label for="cliente">Cliente</label>
            <select name="cliente" id="cliente" class="form-control" required>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->nombre }} {{ $cliente->apellido }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
    <label for="exampleInputEmail1">Monto</label>
    <input type="text"  oninput="formatCurrency(this)" name="monto" id="monto" class="form-control" required>
</div>


  <div class="form-group">
    <label for="exampleInputEmail1">Cuotas </label>
    <input type="number" name="cuotas" oninput="this.value = this.value.replace(/[^0-9]/g, '')" class="form-control" required>
  </div>

  
  <div class="form-group">
    <label for="exampleInputEmail1">Intereses</label>
    <input type="text" name="intereses" id="intereses" class="form-control" required>
</div>


<div class="form-group">
    <label for="cliente">Día de cobro</label>
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


  
<div class="form-group">
    <label for="exampleInputEmail1">Monto de la cuota</label>
    <input oninput="formatCurrency(this)"  type="text" name="monto_cuota" class="form-control" required>
</div>



  <button type="submit" class="btn btn-success">Guardar</button>
  <button type="button" class="btn btn-warning" onclick="limpiarFormulario()" >Limpiar</button>

        </form>
		</div>
	</div>
</div>
<br>
@if(Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<script>
function limpiarFormulario() {
  document.getElementById("myForm").reset();
}
function formatCurrency(input) {
    // Eliminar caracteres no numéricos
    let value = input.value.replace(/[^0-9]/g, '');

    // Dar formato al valor con un signo de dólar y puntos cada tres cifras
    value = '$' + value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

    // Asignar el valor formateado de vuelta al campo de entrada
    input.value = value;
}
</script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>
</html>