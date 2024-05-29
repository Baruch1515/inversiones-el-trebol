<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            @include('layouts/navigation')
        </div>
        <div class="col-md-9">
            <br>
            <h3>Nuevo Cliente</h3>
            <form action="{{ route('guardar.cliente') }}" id="myForm" method="POST">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Nombre </label>
                    <input style="color:white;" type="text" name="nombre" class="form-control">
                </div>
                <br>
                <div class="form-group">
                    <label for="exampleInputEmail1">Apellido </label>
                    <input style="color:white;" type="text" name="apellido" class="form-control">
                </div>
                <br>

                <div class="form-group">
                    <label for="exampleInputEmail1">Telefono</label>
                    <input style="color:white;" type="text" name="telefono" class="form-control"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                </div>

                <br>
                <div class="form-group">
                    <label for="exampleInputEmail1">Barrio </label>
                    <input style="color:white;" type="text" name="barrio" class="form-control">
                </div>

                <br>
                <div class="form-group">
                    <label for="exampleInputEmail1">Direccion </label>
                    <input style="color:white;" type="text" name="direccion" class="form-control">
                </div>
                <br>
                <button type="submit" class="btn btn-success">Guardar</button>
                <button type="button" class="btn btn-warning" onclick="limpiarFormulario()">Limpiar</button>

            </form>
            @if (Session::has('success'))
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
                function limpiarFormulario() {
                    document.getElementById("myForm").reset();
                }
            </script>
        </div>
    </div>
</div>
<style>
    label {
        color: white;
    }

    .form-control {
        border-color: white;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
