<!DOCTYPE html>
<html>
<head>
    <title>Gráfico de dinero registrado</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    @include("layouts/navigation")
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card bg-default">
                            <h5 class="card-header">Recogido el día de hoy</h5>
                            <div class="card-body">
                                <p style="font-size:25px;" class="card-text"> ${{ number_format($sumaCuotasHoy, 0, ',', '.') }}</p>
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
                            <h5 class="card-header">
                                Rutas
                            </h5>
                            <div class="card-body">
                                <canvas id="graficaRutas"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <h5 class="card-header">
                                Card title
                            </h5>
                            <div class="card-body">
                                <p class="card-text">
                                    Card content
                                </p>
                            </div>
                            <div class="card-footer">
                                Card footer
                            </div>
                        </div>
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

</script>

</body>
</html>