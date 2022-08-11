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
                                    <input wire:model.defer="datos.costo" type="number" class="form-control"
                                        name="costo" placeholder="Costo">
                                    @error('datos.costo')
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
