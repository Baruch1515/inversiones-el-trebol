<!DOCTYPE html>
<html lang="en">

<head>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	<script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
	<script src="https://kit.fontawesome.com/0c07597779.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Inversiones El trebol</title>
</head>

<body>
	@include("layouts/navigation")
	<br>
	<form action="{{ route('caja.guardar-registro') }}" method="POST">
    @csrf
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12">
						<h3>
							Resumen de Caja - Inversiones El Trebol
						</h3>
						<div class="row">
							<div class="col-md-6">
								<div class="card">
									<h5 class="card-header">
										Dinero Global
									</h5>
									<div class="card-body">
										<p class="card-text">
											<b>${{ number_format($totalDinero, 3, '.', '.') }}</b>
										</p>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card">
									<h5 class="card-header">
										Dinero en Cartera
									</h5>
									<div class="card-body">
										<p class="card-text">
											<div class="form-group">
											  <input oninput="formatCurrency(this)" type="text" name="dineroCartera" id="" class="form-control" placeholder="" aria-describedby="helpId">
											  <small id="helpId" class="text-muted">Dinero en cartera</small>
											</div>
										</p>
									</div>
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-12">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="card">
									<h5 class="card-header">
										Numero de Clientes
									</h5>
									<div class="card-body">
										<p class="card-text">
											<b>{{$totalClientes}}</b>
										</p>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card">
									<h5 class="card-header">
										Prestamos Activos
									</h5>
									<div class="card-body">
										<p class="card-text">
											<b> {{ $totalPrestamos }}</b>
										</p>
									</div>
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-12">
								<div class="card">
									<h5 class="card-header">
										Ganancias
									</h5>
									<div class="card-body">
										<p class="card-text">
											<b> ${{ $totalGanancias }}</b>
										</p>
									</div>
								</div>
							</div>
						</div>
						<br>
						<div class="d-flex justify-content-between">
						<div class="d-flex justify-content-start gap-5">

    <input type="hidden" name="dineroGlobal" value="{{ $totalDinero }}">
    <input type="hidden" name="totalClientes" value="{{ $totalClientes }}">
    <input type="hidden" name="totalPrestamos" value="{{ $totalPrestamos }}">
    <input type="hidden" name="totalGanancias" value="{{ $totalGanancias }}">
    <button type="submit" class="btn btn-primary">Guardar Registro <i class="fa-solid fa-cloud"></i></button>
  </form>
  
</div>

		
										</div>						

					</div>
				</div>
			</div>
		</div>
	</div>
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
    function formatCurrency(input) {
        // Eliminar caracteres no numéricos
        let value = input.value.replace(/[^0-9]/g, '');

        // Dar formato al valor con un signo de dólar y puntos cada tres cifras
        value = '$' + value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

        // Asignar el valor formateado de vuelta al campo de entrada
        input.value = value;
    }
</script>
</body>

</html>