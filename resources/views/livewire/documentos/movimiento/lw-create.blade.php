<div class="content">
    <div class="container-fluid">
        <div class="row" style="margin-left: 10%">
            <div class="col-md-11">
                <form action="{{ route('movimiento.store') }}" method="post" class="form-horizontal"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select class="form-control" name="user_id">
                                            <option disabled selected>Seleccione el usuario receptor</option>
                                            @foreach ($usuarios as $user)
                                                <option value="{{ $user->id }}">
                                                    {{ $user->usuario->nombre . ' ' . $user->usuario->apellido }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if ($errors->has('user_id'))
                                        <span class="error text-danger"
                                            for="input-user_id">{{ $errors->first('user_id') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Departamento</label>
                                        <input type="text" class="form-control" name="departamento">
                                    </div>
                                    @if ($errors->has('departamento'))
                                        <span class="error text-danger"
                                            for="input-departamento">{{ $errors->first('departamento') }}</span>
                                    @endif
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="date" class="form-control" name="fecha">
                                    </div>
                                    @if ($errors->has('fecha'))
                                        <span class="error text-danger"
                                            for="input-fecha">{{ $errors->first('fecha') }}</span>
                                    @endif
                                </div>
                            </div>
                            <br>

                            <label class="bmd-label-floating">Opcional</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Código</label>
                                        <input type="text" class="form-control" name="codigo">
                                    </div>
                                    @if ($errors->has('codigo'))
                                        <span class="error text-danger"
                                            for="input-codigo">{{ $errors->first('codigo') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select class="form-control" name="tipo">
                                            <option disabled selected>Seleccione el tipo de documento</option>
                                            <option value="Recepción">Recepción </option>
                                            <option value="Comprobante">Comprobante</option>
                                            <option value="Respuesta">Respuesta </option>
                                        </select>
                                    </div>
                                    @if ($errors->has('tipo'))
                                        <span class="error text-danger"
                                            for="input-tipo">{{ $errors->first('tipo') }}</span>
                                    @endif
                                </div>
                            </div>

                            <br>
                            <div class="row">
                                <label for="nombre" class="col-sm-2 col-form-label"> <b> Documento:</b> </label>
                                <div class="col-sm-7">
                                    <input type="file" class="form-control" name="documento[]" } multiple>
                                    @if ($errors->has('documento'))
                                        <span class="error text-danger"
                                            for="input-documento">{{ $errors->first('documento') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="card-footer ml-auto mr-auto">
                            <button type="submit" class="btn btn-primary">
                                <b>Guardar Datos</b>
                            </button>
                            <a href="{{ route('recepcion.show', $recepcion->id) }}"
                                class="btn btn-primary"><b>Cancelar</b></a>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
