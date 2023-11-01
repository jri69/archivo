@extends('layouts.app', ['activePage' => 'pago', 'titlePage' => 'Editar Pago'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row" style="margin-left: 10%">
                <div class="col-md-11">
                    <form action="{{ route('pago.update', $pago->id) }}" method="post" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Monto:</b> </label>
                                    <div class="col-sm-7">
                                        <input type="number" class="form-control" name="monto"
                                            value="{{ old('monto', $pago->monto) }}" autofocus>
                                        @if ($errors->has('monto'))
                                            <span class="error text-danger" for="input-nombre">
                                                {{ $errors->first('monto') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Fecha:</b> </label>
                                    <div class="col-sm-7">
                                        <input type="date" class="form-control" name="fecha"
                                            value="{{ old('fecha', $pago->fecha) }}" autofocus>
                                        @if ($errors->has('fecha'))
                                            <span class="error text-danger" for="input-nombre">
                                                {{ $errors->first('fecha') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Nro. Comprobante:</b>
                                    </label>
                                    <div class="col-sm-7">
                                        <input type="number" class="form-control" name="comprobante"
                                            value="{{ old('comprobante', $pago->comprobante) }}" autofocus>
                                        @if ($errors->has('comprobante'))
                                            <span class="error text-danger" for="input-nombre">
                                                {{ $errors->first('comprobante') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"><b>Comprobante:</b></label>
                                    <div class="col-sm-7">
                                        <input type="file" class="form-control" name="compro_file"
                                            placeholder="Seleccione un documento..." autofocus>
                                        @if ($errors->has('compro_file'))
                                            <span class="error text-danger" for="input-nombre">
                                                {{ $errors->first('compro_file') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Tipo de Pago:</b> </label>
                                    <div class="col-sm-7">
                                        <select name="tipo_pago_id" id="_area" class="form-control">
                                            <option disabled selected>Seleccione el Tipo de pago</option>
                                            @foreach ($pagos as $pago)
                                                <option value="{{ $pago->id }}"
                                                    {{ old('tipo_pago_id', $pago->tipo_pago_id) == $pago->id ? 'selected' : '' }}>
                                                    {{ $pago->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Observaciones:</b> </label>
                                    <div class="col-sm-7">
                                        <textarea class="form-control" name="observaciones" id="" cols="60" rows="3"
                                            placeholder="Observaciones...">{{ $pago->observaciones }}</textarea>
                                    </div>
                                </div>
                                <br>
                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit"class="btn btn-primary">
                                    <b>Guardar Datos</b>
                                </button>
                                <a href="{{ route('pago_estudiante.show_programa', $pago) }}"
                                    class="btn btn-primary"><b>Cancelar</b></a>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
