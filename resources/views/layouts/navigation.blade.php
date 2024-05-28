<head>
    <!-- Libraries Stylesheet -->
    <link rel="stylesheet" href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}">

    <link rel="stylesheet" href="{{ asset('lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}">

    <!-- Customized Bootstrap Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">


    <!-- Template Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>
<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-secondary navbar-dark">
        <a href="{{ route('dashboard') }}" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary"><i class="fa fa-solid fa-clover me-2"></i></i>El Trebol</h3>

        </a>
        <div class="navbar-nav w-100">
            <a href="{{ route('dashboard') }}" class="nav-item nav-link active"><i
                    class="fa fa-tachometer-alt me-2"></i>Inicio</a>



            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                        class="far fa-file-alt me-2"></i>Cuotas</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="{{ route('cuotas.create') }}" class="dropdown-item">Nueva Cuota</a>
                    <a href="{{ route('cuotas') }}" class="dropdown-item">Registro de Cuotas</a>
                </div>
            </div>



            <a href="{{ route('nuevo-prestamo') }}" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Nuevo
                Prestamo</a>

            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                        class="far fa-file-alt me-2"></i>Cuotas</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="{{ route('cuotas.create') }}" class="dropdown-item">Nueva Cuota</a>
                    <a href="{{ route('cuotas') }}" class="dropdown-item">Registro de Cuotas</a>
                </div>
            </div>

            <a href="{{ route('rutas') }}" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Rutas</a>

            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                        class="far fa-file-alt me-2"></i>Caja</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="{{ route('caja.index') }}" class="dropdown-item">Caja</a>
                    <a href="{{ route('registros.index') }}" class="dropdown-item">Registro de Caja</a>
                </div>
            </div>
        </div>
    </nav>
</div>
<!-- Sidebar End -->
