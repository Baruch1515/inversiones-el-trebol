<ul class="nav">
				<li class="nav-item">
					<a class="nav-link active" href="{{ route('dashboard') }}">Inicio</a>
				</li>
				<li class="nav-item">
				</li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('nuevo-cliente') }}">Nuevo Cliente</a>
                </li>
				<li class="nav-item">
					<a class="nav-link" href="{{ route('nuevo-prestamo') }}">Nuevo Prestamo</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{ route('clientes.ver') }}">Clientes</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{ route('cuotas.create') }}">Nueva Cuota</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{ route('cuotas') }}">Cuotas</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{ route('caja.index') }}">Caja</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{ route('registros.index') }}">Registro de caja</a>
				</li>
                </li>
				<li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); this.closest('form').submit();" class="dropdown-item">
                    Cerrar Sesión
                </a>
                </form>

				</li>
			</ul>