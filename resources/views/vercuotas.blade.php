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
    @include("layouts/navigation")
    <br>

    <div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<h3>
				Registro de Cuotas
			</h3>
			<table class="table table-striped table-hover table-sm">
				<thead>
					<tr>
						<th>
							#
						</th>
						<th>
							Nombre
						</th>
						<th>
							Cuota
						</th>
						<th>
							Fecha
						</th>
						<th>
							Acciones
						</th>
					</tr>
				</thead>
				<tbody>
                @foreach ($cuotas as $cuota)
					<tr>
                    <td>{{ $cuota->id }}</td>
                    <td>{{ $cuota->prestamo->cliente->nombre }} {{ $cuota->prestamo->cliente->apellido }}</td>
                    <td>${{ $cuota->monto_cuota }}</td>
                    <td>{{ $cuota->fecha }}</td>
					<td>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $cuota->id }}">
            <i class="fa-solid fa-trash"></i>
            </button>
            <!-- Modal -->

			<div class="modal fade" id="deleteModal{{ $cuota->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <form action="{{ route('cuotas.destroy', $cuota->id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
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
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>
</html>