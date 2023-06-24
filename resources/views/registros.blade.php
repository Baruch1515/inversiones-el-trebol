<!DOCTYPE html>
<html lang="en">
    <head>
    <script src="https://apis.google.com/js/api.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/0c07597779.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inversiones El trebol</title>
    </head>
<body>
    @include("layouts/navigation")
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h3>
                    Registro de Caja
                </h3>
                <table id="tabla" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>
                                #
                            </th>
                            <th>
                                Fecha
                            </th>
                            <th>
                                Dinero Global
                            </th>
                            <th>
                                Dinero en Cartera
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cajas as $caja)
                        <tr>
                            <td>
                                {{$caja->id}}
                            </td>
                            <td>
                                {{$caja->created_at}}
                            </td>
                            <td>
                                ${{$caja->dinero_global}}
                            </td>
                            <td>
                                ${{$caja->dinero_cartera}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table> 
            </div>
        </div>
    </div>
</body>
</html>