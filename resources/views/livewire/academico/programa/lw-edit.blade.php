<div class="content">
    <div class="container-fluid">
        <div class="row" style="margin-left: 10%">
            <div class="col-md-11">
                <form class="form-horizontal" enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <label for="nombre" class="col-sm-2 col-form-label"> <b> Nombre:</b>
                                </label>
                                <div class="col-sm-7">
                                    <input wire:model.defer="datos.nombre" type="text" class="form-control"
                                        name="nombre" placeholder="Nombre">
                                    @error('datos.nombre')
                                        <span class="error text-danger" for="input-nombre">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <label for="nombre" class="col-sm-2 col-form-label"><b>Tipo:</b></label>
                                <div class="col-sm-7">
                                    <select wire:model.defer="datos.tipo" name="tipo" id="tipo"
                                        class="form-control">
                                        <option value="Sin tipo" {{ $datos['tipo'] == 'Sin tipo' ? 'selected' : '' }}>
                                            Seleccione el tipo de programa</option>
                                        <option value="Doctorado" {{ $datos['tipo'] == 'Doctorado' ? 'selected' : '' }}>
                                            Doctorado</option>
                                        <option value="Maestria" {{ $datos['tipo'] == 'Maestria' ? 'selected' : '' }}>
                                            Maestria</option>
                                        <option value="Diplomado" {{ $datos['tipo'] == 'Diplomado' ? 'selected' : '' }}>
                                            Diplomado</option>
                                        <option value="Especialidad"
                                            {{ $datos['tipo'] == 'Especialidad' ? 'selected' : '' }}> Especialidad
                                        </option>
                                        <option value="Cursos" {{ $datos['tipo'] == 'Cursos' ? 'selected' : '' }}>
                                            Cursos</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <label for="nombre" class="col-sm-2 col-form-label"> <b> Sigla:</b> </label>
                                <div class="col-sm-7">
                                    <input wire:model.defer="datos.sigla" type="text" class="form-control"
                                        name="sigla" placeholder="Sigla">
                                    @error('datos.sigla')
                                        <span class="error text-danger" for="input-nombre">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <label for="nombre" class="col-sm-2 col-form-label"> <b> Versión:</b> </label>
                                <div class="col-sm-7">
                                    <input wire:model.defer="datos.version" type="text" class="form-control"
                                        name="version" placeholder="Versión">
                                    @error('datos.version')
                                        <span class="error text-danger" for="input-nombre">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <label for="nombre" class="col-sm-2 col-form-label"> <b> Edición:</b> </label>
                                <div class="col-sm-7">
                                    <input wire:model.defer="datos.edicion" type="text" class="form-control"
                                        name="edicion" placeholder="Edición">
                                    @error('datos.edicion')
                                        <span class="error text-danger" for="input-nombre">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <label for="nombre" class="col-sm-2 col-form-label"> <b> Horas Academicas:</b>
                                </label>
                                <div class="col-sm-7">
                                    <input wire:model.defer="datos.hrs_academicas" type="number" class="form-control"
                                        name="edicion" placeholder="Horas Academicas">
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
                                </div>
                                <div class="col-sm-7">
                                    @error('datos.modalidad')
                                        <span class="error text-danger" for="input-nombre">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <label for="nombre" class="col-sm-2 col-form-label"> <b> Fecha de inicio:</b> </label>
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
                                <label for="nombre" class="col-sm-2 col-form-label"> <b> Fecha de finalización:</b>
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
                            <div class="row">
                                <label for="nombre" class="col-sm-2 col-form-label"> <b> Costo:</b> </label>
                                <div class="col-sm-7">
                                    <input wire:model.defer="datos.costo" type="text" class="form-control"
                                        name="costo" placeholder="Costo">
                                    @error('datos.costo')
                                        <span class="error text-danger" for="input-nombre">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ml-auto mr-auto">
                            <a wire:click="store()" class="btn btn-primary text-white">
                                <b>Guardar Datos</b>
                            </a>
                            <a href="{{ route('programa.show', $programa->id) }}"
                                class="btn btn-primary"><b>Cancelar</b></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
