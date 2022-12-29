<div class="content">
    <div class="container-fluid">
        <div class="form-row">
            <div class="col">
                <div class="form-group label-floating has-success">
                    <input type="text" class="form-control" placeholder="Buscar...." wire:model.lazy="attribute">
                    <span class="form-control-feedback">
                        <i class="material-icons">search</i>
                    </span>
                </div>
            </div>
            <div class="col text-right">
                <a href="{{ route('estudiante.create') }}" class="btn btn-outline-primary btn-white">
                    <b>Agregar Estudiante</b>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4>Listado de Estudiantes</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="text-primary text-dark">
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Cedula</th>
                                    <th>Estado</th>
                                    <th>Correo</th>
                                    <th>Telefono</th>
                                    <th>Nacionalidad</th>
                                    <th>Acciones</th>
                                </thead>
                                <tbody>
                                    @foreach ($estudiantes as $estudiante)
                                        <tr>
                                            <td>{{ $estudiante->id }} </td>
                                            <td>{{ $estudiante->nombre }}
                                                @if ($estudiante->numero_registro)
                                                    <br>
                                                    <small>Reg: {{ $estudiante->numero_registro }}</small>
                                                @endif
                                            </td>
                                            <td>{{ $estudiante->cedula ? $estudiante->cedula : 'Sin cedula' }}</td>
                                            <td>
                                                @if ($estudiante->estado == 'Activo')
                                                    <span class="badge badge-success">Activo</span>
                                                @else
                                                    <span class="badge badge-danger">Inactivo</span>
                                                @endif
                                            </td>
                                            <td>{{ $estudiante->email ? $estudiante->email : 'Sin correo' }}</td>
                                            <td>{{ $estudiante->telefono ? $estudiante->telefono : 'Sin telefono' }}
                                            </td>
                                            <td>{{ $estudiante->telefono ? $estudiante->telefono : 'Sin telefono' }}
                                            </td>
                                            <td>{{ $estudiante->nacionalidad ? $estudiante->nacionalidad : '-' }}</td>
                                            <td class="td-actions">
                                                <a href="{{ route('estudiante.show', $estudiante->id) }}"
                                                    class="btn btn-success">
                                                    <span class="material-icons">visibility</span>
                                                </a>
                                                <form action="{{ route('estudiante.delete', $estudiante->id) }}"
                                                    method="POST" style="display: inline-block;"
                                                    onsubmit="return confirm('¿Está seguro?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" type="submit">
                                                        <i class="material-icons">close</i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!---paginacion-->
                    <div class="row">
                        <div class="col">
                            {{ $estudiantes->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
