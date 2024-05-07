


<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Unna:wght@700&display=swap" rel="stylesheet">
<link rel="icon" type="image/jpg" href="https://cdn.pixabay.com/photo/2012/04/01/18/29/four-leaf-clover-23901_960_720.png">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>


<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Inversiones El Trebol</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
        <a class="nav-link active text-primary" aria-current="page" href="{{ route('dashboard') }}">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="{{ route('nuevo-cliente') }}">Nuevo Cliente</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="{{ route('nuevo-prestamo') }}">Nuevo Prestamo</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="{{ route('clientes.ver') }}">Clientes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="{{ route('cuotas.create') }}">Nueva Cuota</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="{{ route('cuotas') }}">Cuotas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="{{ route('caja.index') }}">Caja</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="{{ route('registros.index') }}">Registro de caja</a>
        </li>
        </li>
      </ul>
    </div>
  </div>
</nav>