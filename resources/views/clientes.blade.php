<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            @include('layouts/navigation')
        </div>
        <div class="col-md-9">
            <br>
            <h3>Clientes</h3>
            <input style="border-color:white;" type="text" id="search" class="form-control"
                placeholder="Buscar clientes...">
            <br>
            <table class="table table-sm table-dark-custom table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Telefono</th>
                        <th>Barrio</th>
                        <th>Dirección</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="clientes-table-body">
                    @foreach ($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->id }}</td>
                            <td>{{ $cliente->nombre }}</td>
                            <td>{{ $cliente->apellido }}</td>
                            <td>{{ $cliente->telefono }}</td>
                            <td>{{ $cliente->barrio }}</td>
                            <td>{{ $cliente->direccion }}</td>
                            <td>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $cliente->id }}">
                                    Editar <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $cliente->id }}">
                                    Eliminar <i class="fa-solid fa-trash"></i>
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="deleteModal{{ $cliente->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="color: black;" class="modal-title" id="exampleModalLabel">
                                                    Confirmar Eliminación
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div style="color: black;" class="modal-body">
                                                <p>¿Estás seguro de que deseas eliminar este registro?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('clientes.destroy', $cliente->id) }}"
                                                    method="POST" style="display: inline-block;"> @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if (session('error'))
                                @endif
                                <div class="modal" id="editModal{{ $cliente->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="color:black;" class="modal-title" id="exampleModalLabel">
                                                    Editar</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('clientes.update', $cliente->id) }}"
                                                    id="myForm" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label style="color:black;" for="exampleInputEmail1">Nombre
                                                        </label>
                                                        <input style="color:white;" value="{{ $cliente->nombre }}"
                                                            type="text" name="nombre" class="form-control">
                                                    </div>
                                                    <br>
                                                    <div class="form-group">
                                                        <label style="color:black;" for="exampleInputEmail1">Apellido
                                                        </label>
                                                        <input style="color:white;" value="{{ $cliente->apellido }}"
                                                            type="text" name="apellido" class="form-control">
                                                    </div>
                                                    <br>

                                                    <div class="form-group">
                                                        <label style="color:black;"
                                                            for="exampleInputEmail1">Telefono</label>
                                                        <input style="color:white;" value="{{ $cliente->telefono }}"
                                                            type="text" name="telefono" class="form-control"
                                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                                    </div>

                                                    <br>
                                                    <div class="form-group">
                                                        <label style="color:black;" for="exampleInputEmail1">Barrio
                                                        </label>
                                                        <input style="color:white;" value="{{ $cliente->barrio }}"
                                                            type="text" name="barrio" class="form-control">
                                                    </div>

                                                    <br>
                                                    <div class="form-group">
                                                        <label style="color:black;" for="exampleInputEmail1">Direccion
                                                        </label>
                                                        <input style="color:white;" value="{{ $cliente->direccion }}"
                                                            type="text" name="direccion" class="form-control">
                                                    </div>
                                                    <br>
                                                    <button type="submit" class="btn btn-success">Guardar</button>
                                                    <button type="button" class="btn btn-warning"
                                                        onclick="limpiarFormulario()">Limpiar</button>

                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if ($clientes->hasPages())
                <ul class="pagination">
                    {{-- Flecha Izquierda --}}
                    @if ($clientes->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link" aria-hidden="true"><i class="fa-solid fa-left-long"></i></span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $clientes->previousPageUrl() }}" rel="prev"
                                aria-label="@lang('pagination.previous')">
                                <span aria-hidden="true"><i class="fa-solid fa-left-long"></i></span>
                            </a>
                        </li>
                    @endif

                    {{-- Flecha Derecha --}}
                    @if ($clientes->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $clientes->nextPageUrl() }}" rel="next"
                                aria-label="@lang('pagination.next')">
                                <span aria-hidden="true"><i class="fa-solid fa-right-long"></i></span>
                            </a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <span class="page-link" aria-hidden="true"><i class="fa-solid fa-right-long"></i></span>
                        </li>
                    @endif
                </ul>
            @endif
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('search').addEventListener('keyup', function() {
            let query = this.value;

            fetch(`/search-clientes?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    let tableBody = document.getElementById('clientes-table-body');
                    if (tableBody) {
                        tableBody.innerHTML = '';
                        data.forEach(cliente => {
                            tableBody.innerHTML += `
                                <tr>
                                    <td>${cliente.id}</td>
                                    <td>${cliente.nombre}</td>
                                    <td>${cliente.apellido}</td>
                                    <td>${cliente.telefono}</td>
                                    <td>${cliente.barrio}</td>
                                    <td>${cliente.direccion}</td>
                                    <td>
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editModal${cliente.id}">
                                            Editar <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal${cliente.id}">
                                            Eliminar <i class="fa-solid fa-trash"></i>
                                        </button>
                                        
                                        <!-- Modal de eliminación -->
                                        <div class="modal fade" id="deleteModal${cliente.id}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 style="color: black;" class="modal-title" id="exampleModalLabel">Confirmar Eliminación</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div style="color: black;" class="modal-body">
                                                        <p>¿Estás seguro de que deseas eliminar este registro?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="/clientes/${cliente.id}" method="POST" style="display: inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
    
                                        <!-- Modal de edición -->
                                        <div class="modal fade" id="editModal${cliente.id}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 style="color:black;" class="modal-title" id="exampleModalLabel">Editar</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="/clientes/${cliente.id}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label style="color:black;" for="nombre">Nombre</label>
                                                                <input style="color:white;" value="${cliente.nombre}" type="text" name="nombre" class="form-control">
                                                            </div>
                                                            <br>
                                                            <div class="form-group">
                                                                <label style="color:black;" for="apellido">Apellido</label>
                                                                <input style="color:white;" value="${cliente.apellido}" type="text" name="apellido" class="form-control">
                                                            </div>
                                                            <br>
                                                            <div class="form-group">
                                                                <label style="color:black;" for="telefono">Telefono</label>
                                                                <input style="color:white;" value="${cliente.telefono}" type="text" name="telefono" class="form-control" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                                            </div>
                                                            <br>
                                                            <div class="form-group">
                                                                <label style="color:black;" for="barrio">Barrio</label>
                                                                <input style="color:white;" value="${cliente.barrio}" type="text" name="barrio" class="form-control">
                                                            </div>
                                                            <br>
                                                            <div class="form-group">
                                                                <label style="color:black;" for="direccion">Direccion</label>
                                                                <input style="color:white;" value="${cliente.direccion}" type="text" name="direccion" class="form-control">
                                                            </div>
                                                            <br>
                                                            <button type="submit" class="btn btn-success">Guardar</button>
                                                            <button type="button" class="btn btn-warning" onclick="limpiarFormulario()">Limpiar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            `;
                        });
                    }
                });
        });
    });
</script>

<style>
    .table {
        background-color: black;
        color: white;
    }

    .table th,
    .table td {
        color: white;
        border: 0.4px solid white;
        /* Añadir bordes */
    }
</style>
