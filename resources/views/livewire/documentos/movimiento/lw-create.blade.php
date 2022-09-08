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
                                        <label class="bmd-label-floating">Código</label>
                                        <input type="text" class="form-control" name="codigo"
                                            wire:model.defer="datos.codigo">
                                    </div>
                                    @error('datos.codigo')
                                        <span class="error text-danger" for="input-codigo">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select class="form-control" name="user_id" wire:model.defer="datos.user_id">
                                            <option disabled value="">Seleccione el usuario receptor</option>
                                            @foreach ($usuarios as $user)
                                                <option value="{{ $user->id }}">
                                                    {{ $user->usuario->nombre . ' ' . $user->usuario->apellido }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('datos.user_id')
                                        <span class="error text-danger" for="input-user_id">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Departamento</label>
                                        <input type="text" class="form-control" name="departamento"
                                            wire:model.defer="datos.departamento">
                                    </div>
                                    @error('datos.departamento')
                                        <span class="error text-danger" for="input-departamento">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="date" class="form-control" name="fecha"
                                            wire:model.defer="datos.fecha">
                                    </div>
                                    @error('datos.fecha')
                                        <span class="error text-danger" for="input-fecha">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <label for="nombre" class="col-sm-2 col-form-label"> <b> Descripción:</b> </label>
                                <div class="col-sm-7">
                                    <textarea class="form-control" name="descripcion" rows="3" wire:model.defer='datos.descripcion'></textarea>
                                    @error('datos.descripcion')
                                        <span class="error text-danger" for="input-descripcion">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            {{-- h2 con mensaje de opcional --}}
                            <br>
                            <h4 class="text-primary h4">Opcional</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select class="form-control" name="tipo" wire:model.defer="datos.tipo">
                                            <option disabled value="">Seleccione el tipo de documento</option>
                                            <option value="Recepción">Recepción </option>
                                            <option value="Comprobante">Comprobante</option>
                                            <option value="Respuesta">Respuesta </option>
                                        </select>
                                    </div>
                                    @error('datos.tipo')
                                        <span class="error text-danger" for="input-tipo">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <label for="nombre" class="col-sm-2 col-form-label"> <b> Documento:</b> </label>
                                <div class="col-sm-7">
                                    <input type="file" class="form-control" name="documento"
                                        wire:model.defer="datos.documento">
                                    @error('datos.documento')
                                        <span class="error text-danger" for="input-documento">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <br>

                        </div>

                        <div class="card-footer ml-auto mr-auto">
                            <a class="btn btn-primary text-white" wire:click="save()">
                                <b>Guardar Datos</b>
                            </a>
                            <a href="{{ route('recepcion.show', $recepcion->id) }}"
                                class="btn btn-primary"><b>Cancelar</b></a>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
