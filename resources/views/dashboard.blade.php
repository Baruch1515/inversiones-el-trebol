<!DOCTYPE html>
<html lang="en">

<head>
	<script src="https://kit.fontawesome.com/0c07597779.js" crossorigin="anonymous"></script>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Inversiones El trebol</title>
	<script src="{{ asset('js/dashboard.js') }}"></script>
</head>

<body>
	@include("layouts/navigation")
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">

				<div class="row">
					<div class="col-md-12">

					<form action="{{ route('dashboard') }}" method="GET" class="row g-3">
    <div class="col-auto">
        <label for="cobro" class="visually-hidden">Día de cobro</label>
    </div>
    <div class="col-auto">
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
    <div class="col-auto">
        <button type="submit" class="btn btn-primary">Filtrar</button>
    </div>
</form>
<form action="{{ route('dashboard') }}" method="GET">
    <div class="col-auto mt-3">
        <button type="submit" class="btn btn-secondary">Mostrar Todos</button>
    </div>
</form>



						<br>

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
</body>

</html>