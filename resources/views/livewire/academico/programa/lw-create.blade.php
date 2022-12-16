<div class="content">
    <div class="container-fluid">
        <div class="row" style="margin-left: 10%">
            <div class="col-md-11">
                <form class="form-horizontal" enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Nombre del programa</label>
                                        <input wire:model.defer="datos.nombre" type="text" class="form-control"
                                            name="nombre">
                                    </div>
                                    @error('datos.nombre')
                                        <span class="error text-danger" for="input-nombre">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Sigla</label>
                                        <input wire:model.defer="datos.sigla" type="text" class="form-control"
                                            name="sigla">
                                    </div>
                                    @error('datos.sigla')
                                        <span class="error text-danger" for="input-nombre">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select class="form-control" name="tipo" wire:model.defer='datos.tipo'>
                                            <option value="Sin tipo">Seleccione el tipo de programa</option>
                                            <option value="Doctorado"> Doctorado</option>
                                            <option value="Maestria"> Maestria</option>
                                            <option value="Diplomado"> Diplomado</option>
                                            <option value="Especialidad"> Especialidad</option>
                                            <option value="Cursos"> Cursos</option>
                                        </select>
                                    </div>
                                    @error('datos.tipo')
                                        <span class="error text-danger" for="input-tipo">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombre" class="bmd-label-floating">Versión</label>
                                        <input wire:model.defer="datos.version" type="text" class="form-control"
                                            name="version">
                                    </div>
                                    @error('datos.version')
                                        <span class="error text-danger" for="input-nombre">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombre" class="bmd-label-floating">Edición</label>
                                        <input wire:model.defer="datos.edicion" type="text" class="form-control"
                                            name="edicion">
                                    </div>
                                    @error('datos.edicion')
                                        <span class="error text-danger" for="input-nombre">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <br>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Costo</label>
                                        <input wire:model.defer="datos.costo" type="number" class="form-control"
                                            name="costo">
                                    </div>
                                    @error('datos.costo')
                                        <span class="error text-danger" for="input-nombre">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombre" class="bmd-label-floating">Horas académicas</label>
                                        <input wire:model.defer="datos.hrs_academicas" type="number"
                                            class="form-control" name="hrs_academicas">
                                    </div>
                                    @error('datos.hrs_academicas')
                                        <span class="error text-danger" for="input-nombre">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <label for="nombre" class="col-sm-2 col-form-label"> <b> Modalidad:</b>
                                </label>
                                <div class="col-sm-7">
                                    <input wire:model.defer="datos.modalidad" type="radio" name="modalidad"
                                        value="Presencial">
                                    <span>Presencial</span>

                                    <input wire:model.defer="datos.modalidad" type="radio" name="modalidad"
                                        value="Virtual" style='margin-left: 20px'>
                                    <span>Virtual</span>

                                    <input wire:model.defer="datos.modalidad" type="radio" name="modalidad"
                                        value="Semi-Presencial" style='margin-left: 20px'>
                                    <span>Semi-Presencial</span>
                                </div>
                                <div class="col-sm-7">
                                    @error('datos.modalidad')
                                        <span class="error text-danger" for="input-nombre">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <label for="nombre" class="col-sm-2 col-form-label"> <b> Fecha de inicio:</b>
                                </label>
                                <div class="col-sm-7">
                                    <input wire:model.defer="datos.fecha_inicio" type="date" class="form-control"
                                        name="fecha_inicio">
                                    @error('datos.fecha_inicio')
                                        <span class="error text-danger" for="input-nombre">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <label for="nombre" class="col-sm-2 col-form-label"> <b> Fecha de
                                        finalización:</b>
                                </label>
                                <div class="col-sm-7">
                                    <input wire:model.defer='datos.fecha_finalizacion' type="date"
                                        class="form-control" name="fecha_finalizacion">
                                    @error('datos.fecha_finalizacion')
                                        <span class="error text-danger" for="input-nombre">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <br>

                        </div>

                        <div class="card-footer ml-auto mr-auto">
                            <a wire:click="store()" class="btn btn-primary text-white">
                                <b>Guardar Datos</b>
                            </a>
                            <a href="{{ route('programa.index') }}" class="btn btn-primary"><b>Cancelar</b></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
