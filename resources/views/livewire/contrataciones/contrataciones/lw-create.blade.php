<div class="content">
    <div class="container-fluid">
        <div class="row" style="margin-left: 10%">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <label for="nombre" class="col-sm-2 col-form-label"> <b> Modulo:</b> </label>
                            <div class="col-sm-7">
                                <select class="form-control" name="modulo_id" wire:model="datos.modulo_id">
                                    <option disabled value="">Seleccione el modulo</option>
                                    @foreach ($modulos as $modulo)
                                        <option value="{{ $modulo->id }}">
                                            {{ $modulo->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('datos.modulo_id')
                                    <span class="error text-danger" for="input-modulo_id">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <label for="nombre" class="col-sm-2 col-form-label"> <b> Fecha Inicio:</b> </label>
                            <div class="col-sm-7">
                                <input type="date" class="form-control" name="fecha_inicio"
                                    wire:model.defer="datos.fecha_inicio">
                                @error('datos.fecha_inicio')
                                    <span class="error text-danger" for="input-fecha_inicio">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <label for="nombre" class="col-sm-2 col-form-label"> <b> Fecha Fin:</b> </label>
                            <div class="col-sm-7">
                                <input type="date" class="form-control" name="fecha_final"
                                    wire:model.defer="datos.fecha_final">
                                @error('datos.fecha_final')
                                    <span class="error text-danger" for="input-fecha_final">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <label for="nombre" class="col-sm-2 col-form-label"> <b> Pago:</b> </label>
                            <div class="col-sm-7">
                                <input type="number" class="form-control" name="honorario" placeholder="Pago"
                                    wire:model.defer="datos.honorario">
                                @error('datos.honorario')
                                    <span class="error text-danger" for="input-honorario">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <label for="nombre" class="col-sm-2 col-form-label"> <b> Nro de preventiva:</b>
                            </label>
                            <div class="col-sm-7">
                                <input type="number" class="form-control" name="nro_preventiva"
                                    placeholder="Numero de preventiva" wire:model.defer="datos.nro_preventiva">
                                @error('datos.nro_preventiva')
                                    <span class="error text-danger" for="input-nro_preventiva">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <label for="nombre" class="col-sm-2 col-form-label"> <b> Horario:</b> </label>
                            <div class="col-sm-7">
                                <textarea class="form-control" name="horarios" rows="3" wire:model.defer='datos.horarios' placeholder="Horario"></textarea>

                                @error('datos.horarios')
                                    <span class="error text-danger" for="input-horarios">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <br>
                    </div>

                    <div class="card-footer ml-auto mr-auto">
                        <a class="btn btn-primary text-white" wire:click="save()">
                            <b>Guardar Datos</b>
                        </a>
                        <a href="{{ route('docentes.show', $docente->id) }}" class="btn btn-primary"><b>Cancelar</b></a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
