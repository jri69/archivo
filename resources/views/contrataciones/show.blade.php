@extends('layouts.app', ['activePage' => 'contrataciones', 'titlePage' => 'Contrataciones'])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-left">
                    <a href="{{ route('contrataciones.index') }}" class="btn btn-sm btn-primary">
                        <i class="material-icons">keyboard_backspace</i>
                        <span class="sidebar-normal">Volver</span>
                    </a>
                    <a href="{{ route('contrataciones.edit', $contrato->id) }}" class="btn btn-sm btn-primary">
                        <i class="material-icons">edit</i>
                        <span class="sidebar-normal">Actualizar datos</span>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Contrato</h4>
                            <p class="card-category">Informacion del contrato</p>
                        </div>
                        <div class="card-body">
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Docente</label>
                                        <input type="text" class="form-control"
                                            value="{{ $contrato->modulo->docente->honorifico . ' ' . $contrato->modulo->docente->nombre . ' ' . $contrato->modulo->docente->apellido }} "
                                            disabled>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Programa</label>
                                        <input type="text" class="form-control" value="{{ $programa->nombre }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Modulo</label>
                                        <input type="text" class="form-control" value="{{ $contrato->modulo->nombre }}"
                                            disabled>
                                    </div>
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <div class="col-md-6">
                                    <label class="bmd-label-floating">Fecha de inicio</label>
                                    <div class="form-group">
                                        <input type="date" class="form-control" value="{{ $contrato->fecha_inicio }}"
                                            disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="bmd-label-floating">Fecha de finalizacion</label>
                                    <div class="form-group">
                                        <input type="date" class="form-control" value="{{ $contrato->fecha_final }}"
                                            disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Honorarios</label>
                                        <input type="text" class="form-control" value="{{ $contrato->honorario }}"
                                            disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Pagado</label>
                                        <input type="text" class="form-control"
                                            value="{{ $contrato->pagado ? 'Si' : 'No' }}" disabled>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    {{-- text area --}}
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Horario</label>
                                        <textarea class="form-control" rows="3" disabled>{{ $contrato->horarios }}</textarea>
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
                            <h4 class="card-title ">Cartas</h4>
                            <p class="card-category">Lista de cartas</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                        <th>Código</th>
                                        <th>Nombre</th>
                                        <th>Tipo</th>
                                        <th>Fecha</th>
                                        <th>Acciones</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($cartas as $carta)
                                            <tr>
                                                <td>
                                                    {{ $carta->codigo_admi }}
                                                </td>
                                                <td>
                                                    {{ $carta->nombre }}
                                                </td>
                                                <td> {{ $carta->tipo }}</td>
                                                <td> {{ $carta->fecha }}</td>
                                                <td class="td-actions">
                                                    <a {{-- href="{{ route('carta.edit', $carta->id) }}" --}} target="_blank" class="btn btn-success">
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
