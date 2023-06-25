<!DOCTYPE html>
<html lang="en">

<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
	<script src="https://kit.fontawesome.com/0c07597779.js" crossorigin="anonymous"></script>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Inversiones El trebol</title>
	<script src="{{ asset('js/dashboard.js') }}"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>

<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				@include("layouts/navigation")
				<div class="row">
					<div class="col-md-12">
						<h3 class="text-center">
							Inversiones El trebol
						</h3>

						<form action="{{ route('dashboard') }}" method="GET" class="form-inline">
							<div class="form-group mr-2">
								<label for="cobro">Día de cobro</label>
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
							<button type="submit" class="btn btn-primary">Filtrar</button>
						</form><br>

						<table class="table table-bordered table-hover table-sm">
							<thead>
								<tr>
									<th>
										#
									</th>
									<th>
										Cliente
									</th>
									<th>
										Deuda
									</th>
									<th>
										Dia de cobro
									</th>
									<th>
										Acciones
									</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($prestamos as $prestamo)
								<tr>
									<td>
										{{$prestamo->id}}
									</td>
									<td>
										{{$prestamo->cliente->nombre}}
									</td>
									<td>
										${{ $prestamo->dinero_total}}

									</td>

									<td>
										{{$prestamo->cobro}}
									</td>
									<td>
										<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $prestamo->id }}">
											<i class="fa-solid fa-trash"></i>
										</button>
										<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#verModal{{ $prestamo->id }}">
											<i class="fa-solid fa-eye"></i>
										</button>

										<div class="modal fade" id="deleteModal{{ $prestamo->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">Confirmar Eliminación</h5>
														<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
													</div>
													<div class="modal-body">
														<p>¿Estás seguro de que deseas eliminar este registro?</p>
													</div>
													<div class="modal-footer">
														<form action="{{ route('prestamo.destroy', $prestamo->id) }}" method="POST" style="display: inline-block;"> @csrf
															@method('DELETE')
															<button type="submit" class="btn btn-danger">Eliminar</button>
														</form>
													</div>
												</div>
											</div>
										</div>

										<div class="modal fade" id="verModal{{ $prestamo->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">Prestamo</h5>
														<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
													</div>
													<div class="modal-body">
														<p><b>Nombre:</b> {{$prestamo->cliente->nombre}}</p>
														<p><b>Cuotas:</b> {{$prestamo->cuotas}}</p>
														<p><b>Prestamo:</b> ${{$prestamo->monto}}</p>
														<p><b>Intereses:</b> {{$prestamo->intereses}}%</p>
														<p><b>ganancia:</b> ${{$prestamo->ganancia}}</p>
														<p><b>Cuota:</b> ${{$prestamo->monto_cuota}}</p>
														<p><b>Direccion:</b> {{$prestamo->cliente->direccion}}</p>
														<p><b>Fecha de inicio:</b> {{$prestamo->created_at}}</p>
														<p><b>Nota:</b> {{$prestamo->nota}}</p>
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
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>

</html>