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
                <a class="btn btn-primary text-white" wire:click="todos">
                    <i class="material-icons">refresh</i>
                    <b>Todos</b>
                </a>
                <a class="btn btn-primary text-white" wire:click="conDeuda">
                    <i class="material-icons">money</i>
                    <b>Con Deuda</b>
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
                                    <th>Foto</th>
                                    <th>Nombre</th>
                                    <th>Cedula</th>
                                    <th>Correo</th>
                                    <th>Telefono</th>
                                    <th>Nacionalidad</th>
                                    <th>Deuda</th>
                                    <th>Acciones</th>
                                </thead>
                                <tbody>
                                    @foreach ($estudantes_search as $estudiante)
                                        <tr>
                                            <td>{{ $estudiante->id }} </td>
                                            <td>
                                                <img src="{{ asset($estudiante->foto) }}" alt=""
                                                    class="img-fluid" width="50">
                                            </td>
                                            <td>{{ $estudiante->honorifico . ' ' . $estudiante->nombre }}
                                                @if ($estudiante->numero_registro)
                                                    <br>
                                                    <small>Reg: {{ $estudiante->numero_registro }}</small>
                                                @endif
                                            </td>
                                            <td>{{ $estudiante->cedula ? $estudiante->cedula : 'Sin cedula' }}</td>
                                            <td>{{ $estudiante->email ? $estudiante->email : 'Sin correo' }}</td>
                                            <td>{{ $estudiante->telefono ? $estudiante->telefono : 'Sin telefono' }}
                                            </td>
                                            <td>{{ $estudiante->nacionalidad ? $estudiante->nacionalidad : '-' }}</td>
                                            <td>
                                                @if ($estudiante->deuda == 'CON DEUDA')
                                                    <span class="badge badge-danger">Con Deuda</span>
                                                @else
                                                    <span class="badge badge-success">Sin Deuda</span>
                                                @endif
                                            </td>
                                            <td class="td-actions">
                                                <a href="{{ route('pago_estudiante.show', $estudiante->id) }}"
                                                    class="btn btn-success">
                                                    <span class="material-icons">visibility</span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            {{-- {{ $estudiantes->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
