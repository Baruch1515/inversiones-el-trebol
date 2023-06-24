<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inversiones El trebol</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>
<body>
<div class="container-fluid">
	<div class="row">
        @include("layouts/navigation")
        <br>
		<div class="col-md-12">
            <h3>Nuevo Cliente</h3>
        <form action="{{ route('guardar.cliente') }}" id="myForm" method="POST">
        @csrf
  <div class="form-group">
    <label for="exampleInputEmail1">Nombre </label>
    <input type="text" name="nombre" class="form-control">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Apellido </label>
    <input type="text" name="apellido" class="form-control">
  </div>

  
  <div class="form-group">
    <label for="exampleInputEmail1">Telefono</label>
    <input type="text" name="telefono" class="form-control" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
</div>


  <div class="form-group">
    <label for="exampleInputEmail1">Barrio </label>
    <input type="text" name="barrio" class="form-control">
  </div>

  
  <div class="form-group">
    <label for="exampleInputEmail1">Direccion </label>
    <input type="text" name="direccion" class="form-control">
  </div>

  <button type="submit" class="btn btn-success">Guardar</button>
  <button type="button" class="btn btn-warning" onclick="limpiarFormulario()" >Limpiar</button>

        </form>
		</div>
	</div>
</div>
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
<script>
function limpiarFormulario() {
  document.getElementById("myForm").reset();
}
</script>
<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>
</html>