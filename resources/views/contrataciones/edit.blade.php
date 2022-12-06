@extends('layouts.app', ['activePage' => 'contrataciones', 'titlePage' => 'Contrataciones'])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row" style="margin-left: 10%">
                <div class="col-md-11">
                    <form action="{{ route('contrataciones.update', $contrato->id) }}" method="post" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Modulo</label>
                                            <input type="text" class="form-control"
                                                value="{{ $contrato->modulo->nombre }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Docente</label>
                                            <input type="text" class="form-control" name="codigo"
                                                value="{{ $contrato->modulo->docente->honorifico . ' ' . $contrato->modulo->docente->nombre . ' ' . $contrato->modulo->docente->apellido }}"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="">Fecha Inicio</label>
                                            <input type="date" class="form-control" name="fecha_inicio"
                                                value="{{ $contrato->fecha_inicio }}">
                                        </div>
                                        @error('fecha_inicio')
                                            <span class="error text-danger" for="input-fecha_inicio">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="">Fecha Fin</label>
                                            <input type="date" class="form-control" name="fecha_final"
                                                value="{{ $contrato->fecha_final }}">
                                        </div>
                                        @error('fecha_final')
                                            <span class="error text-danger" for="input-fecha_final">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="">Pago</label>
                                            <input type="number" class="form-control" name="honorario" placeholder="Pago"
                                                value="{{ $contrato->honorario }}">
                                        </div>
                                        @error('honorario')
                                            <span class="error text-danger" for="input-honorario">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="">Nro. de preventiva</label>
                                            <input type="text" class="form-control" name="nro_preventiva"
                                                placeholder="Nro. de preventiva" value="{{ $contrato->nro_preventiva }}">
                                        </div>
                                        @error('nro_preventiva')
                                            <span class="error text-danger"
                                                for="input-nro_preventiva">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label for="nombre" class="col-sm-2"> <b> Pagado:</b>
                                    </label>
                                    <div class="col-sm-7">
                                        <input type="radio" name="pagado" value="true"
                                            {{ $contrato->pagado ? 'checked' : '' }}>
                                        <span>Si</span>
                                        <input type="radio" name="pagado" value="false" style="margin-left: 15px"
                                            {{ !$contrato->pagado ? 'checked' : '' }}>
                                        <span>No</span>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Horario:</b> </label>
                                    <div class="col-sm-7">
                                        <textarea class="form-control" name="horarios" rows="3" placeholder="Horario">{{ $contrato->horarios }}</textarea>
                                        @error('horarios')
                                            <span class="error text-danger" for="input-horarios">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit"class="btn btn-primary">
                                    <b>Guardar Datos</b>
                                </button>
                                <a href="{{ route('contrataciones.show', $contrato->id) }}"
                                    class="btn btn-primary"><b>Cancelar</b></a>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
