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
					</tr>
				</thead>
				<tbody>
                @foreach ($cuotas as $cuota)
					<tr>
                    <td>{{ $cuota->id }}</td>
                    <td>{{ $cuota->prestamo->cliente->nombre }} {{ $cuota->prestamo->cliente->apellido }}</td>
                    <td>${{ $cuota->monto_cuota }}</td>
                    <td>{{ $cuota->fecha }}</td>
					</tr>
                    @endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
</body>
</html>