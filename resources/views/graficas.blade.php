<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            @include('layouts/navigation')

        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-6">
                    <div class="card bg-default">
                        <h5 class="card-header">Estado de Rutas</h5>
                        <div class="card-body">
                            <canvas id="graficaRutas"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <h5 class="card-header">Dinero prestado cada mes</h5>
                        <div class="card-body">
                            <canvas id="prestamoPorMesChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <h5 class="card-header">Dinero en la calle</h5>
                        <div class="card-body">
                            <canvas id="crecimientoDineroGlobalChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var ctx = document.getElementById('prestamoPorMesChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Dinero Prestado',
                data: {!! json_encode($montos) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    var ctx = document.getElementById('graficaRutas').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($nombresRutas) !!},
            datasets: [{
                label: 'Dinero Registrado por Ruta',
                data: {!! json_encode($montosPorRuta) !!},
                backgroundColor: {!! json_encode($coloresBarras) !!}, // Aquí asignamos los colores a cada barra
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    var ctx = document.getElementById('crecimientoDineroGlobalChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($fechas) !!},
            datasets: [{
                label: 'Plata repartida',
                data: {!! json_encode($dineroGlobal) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>
