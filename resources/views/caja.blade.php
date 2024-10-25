<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/0c07597779.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inversiones El Trebol</title>
    <style>
        .table-dark-custom {
            background-color: black;
            color: white;
        }

        .table-dark-custom th,
        .table-dark-custom td {
            color: white;
        }

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
</head>
<body>
    @include('layouts/navigation')
    <div class="container my-5">
        <h3 class="text-center mb-4">Resumen de Caja - Inversiones El Trebol</h3>
        <form action="{{ route('caja.guardar-registro') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card text-center">
                        <h5 class="card-header">Dinero Global</h5>
                        <div class="card-body">
                            <p class="card-text"><b>${{ number_format($totalDinero, 0, '.', '.') }}</b></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card text-center">
                        <h5 class="card-header">Dinero en Cartera</h5>
                        <div class="card-body">
                            <div class="form-group">
                                <input oninput="formatCurrency(this)" type="text" name="dineroCartera" id="dineroCartera" class="form-control" placeholder="Ingrese cantidad" aria-describedby="helpId">
                                <small id="helpId" class="text-muted">Dinero en cartera</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card text-center">
                        <h5 class="card-header">Número de Clientes</h5>
                        <div class="card-body">
                            <p class="card-text"><b>{{ $totalClientes }}</b></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card text-center">
                        <h5 class="card-header">Préstamos Activos</h5>
                        <div class="card-body">
                            <p class="card-text"><b>{{ $totalPrestamos }}</b></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card text-center">
                        <h5 class="card-header">Ganancias</h5>
                        <div class="card-body">
                            <p class="card-text"><b>${{ number_format($totalGanancias, 0, '.', '.') }}</b></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card text-center">
                        <h5 class="card-header">Recogido del Día</h5>
                        <div class="card-body">
                            <p class="card-text"><b>${{ number_format($sumaCuotasHoy, 0, ',', '.') }}</b></p>
                        </div>
                    </div>
                </div>
            </div>

            <input type="hidden" name="dineroGlobal" value="{{ $totalDinero }}">
            <input type="hidden" name="totalClientes" value="{{ $totalClientes }}">
            <input type="hidden" name="totalPrestamos" value="{{ $totalPrestamos }}">
            <input type="hidden" name="totalGanancias" value="{{ $totalGanancias }}">
            <input type="hidden" name="sumaCuotasHoy" value="{{ $sumaCuotasHoy }}">
            <button type="submit" class="btn btn-primary btn-block mt-4">Guardar Registro <i class="fa-solid fa-cloud"></i></button>
        </form>
    </div>

    @if (Session::has('success'))
        <div id="floating-alert" class="alert alert-success alert-floating">
            {{ Session::get('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <script>
            var floatingAlert = document.getElementById('floating-alert');
            floatingAlert.classList.add('show');
            setTimeout(function() {
                floatingAlert.classList.remove('show');
            }, 5000);
        </script>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
