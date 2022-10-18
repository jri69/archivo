@extends('layouts.app', ['activePage' => 'docentes', 'titlePage' => 'Docentes'])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-left">
                    <a href="{{ route('docentes.index') }}" class="btn btn-sm btn-primary">
                        <i class="material-icons">keyboard_backspace</i>
                        <span class="sidebar-normal">Volver</span>
                    </a>
                    <a href="{{ route('docentes.edit', $docente->id) }}" class="btn btn-sm btn-primary">
                        <i class="material-icons">edit</i>
                        <span class="sidebar-normal">Actualizar datos</span>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Docente</h4>
                            <p class="card-category">Informacion del Docente</p>
                        </div>
                        <div class="card-body">
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Nombre</label>
                                        <input type="text" class="form-control"
                                            value="{{ $docente->honorifico . ' ' . $docente->nombre . ' ' . $docente->apellido }} "
                                            disabled>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Correo Electrónico</label>
                                        <input type="email" class="form-control" value="{{ $docente->correo }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Telefono</label>
                                        <input type="text" class="form-control" value="{{ $docente->telefono }}"
                                            disabled>
                                    </div>
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Cedula</label>
                                        <input type="text" class="form-control" value="{{ $docente->cedula }} " disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Facturacion</label>
                                        <input type="text" class="form-control"
                                            value="{{ $docente->facturacion ? 'Si' : 'No' }}" disabled>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Contratos</h4>
                            <p class="card-category">Lista de contratos del docente</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                        <th>Código</th>
                                        <th>Modulo</th>
                                        <th>Version</th>
                                        <th>Edicion</th>
                                        <th>Fecha</th>
                                        <th>Acciones</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($contratos as $contrato)
                                            <tr>
                                                <td>
                                                    {{ $contrato->id }}
                                                </td>
                                                <td>
                                                    {{ $contrato->modulo->nombre }}
                                                </td>
                                                <td> {{ $contrato->modulo->version }}</td>
                                                <td> {{ $contrato->modulo->edicion }}</td>
                                                <td>
                                                    {{ date('d-m-Y', strtotime($contrato->fecha)) }}
                                                </td>
                                                <td class="td-actions">
                                                    <a href="{{ route('contrataciones.show', $contrato->id) }}"
                                                        target="_blank" class="btn btn-success">
                                                        <span class="material-icons">visibility</span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
