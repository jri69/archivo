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
                <a href="{{ route('modulo.create') }}" class="btn btn-outline-primary btn-white">
                    <b>Agregar Módulo</b>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4>Listado de Módulos</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="text-primary text-dark">
                                    <th>Codigo</th>
                                    <th>Programa</th>
                                    <th>Modulo</th>
                                    <th>Docente</th>
                                    <th>Calificacion</th>
                                    <th>Fecha inicio</th>
                                    <th>Fecha final</th>
                                    <th>Acciones</th>
                                </thead>
                                <tbody>
                                    @foreach ($modulos as $modulo)
                                        <tr>
                                            <td>{{ $modulo->codigo }} </td>
                                            <td>{{ $modulo->programa->sigla . ' ' . $modulo->programa->version . '.' . $modulo->programa->edicion }}
                                            </td>
                                            <td>{{ $modulo->nombre }}
                                                <span>{{ $modulo->version . '.' . $modulo->edicion }}</span>
                                                <br>
                                                <small class="">
                                                    {{ $modulo->modalidad }}
                                                </small>
                                            </td>
                                            <td>{{ $modulo->docente->honorifico . ' ' . $modulo->docente->nombre . ' ' . $modulo->docente->apellido }}
                                            </td>
                                            <td>{{ $modulo->cal_docente ? $modulo->cal_docente : '-' }}</td>
                                            <td>{{ date('d-m-Y', strtotime($modulo->fecha_inicio)) }}</td>
                                            <td>{{ date('d-m-Y', strtotime($modulo->fecha_final)) }}</td>

                                            <td class="td-actions">
                                                <a href="{{ route('modulo.show', $modulo->id) }}"
                                                    class="btn btn-success">
                                                    <span class="material-icons">visibility</span>
                                                </a>
                                                <form action="{{ route('modulo.delete', $modulo->id) }}" method="POST"
                                                    style="display: inline-block;"
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
                    <div class="row">
                        <div class="col">
                            {{ $modulos->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
