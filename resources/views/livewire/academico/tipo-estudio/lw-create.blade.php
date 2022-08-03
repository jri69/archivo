<div class="content">
    <div class="container-fluid">
        <div class="row" style="margin-left: 10%">
            <div class="col-md-11">
                <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
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
                                <label for="nombre" class="col-sm-2 col-form-label"><b>Módulos:</b></label>
                                <div class="col-sm-7">
                                    <select wire:model.defer="idModulo" name="modulo_id" id="_modulo"
                                        class="form-control">
                                        <option value="null" selected>Seleccione el módulo</option>
                                        @foreach ($modulos as $modulo)
                                            <option value="{{ $modulo->id }}">{{ $modulo->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <br>
                                <a wire:click="add()" class="btn btn-success btn-fab btn-fab-mini btn-round text-white">
                                    <i class="material-icons">add</i>
                                </a>
                            </div>
                        </div>
                        <div class="card-footer ml-auto mr-auto">
                            <a wire:click="store" class="text-white btn btn-primary">
                                <b>Guardar Datos</b>
                            </a>
                            <a href="{{ route('estudio.index') }}" class="btn btn-primary"><b>Cancelar</b></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row" style="margin-left: 10%">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4>Listado de Módulos</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Sigla</th>
                                        <th>Nombre</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lista as $key => $mod)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td>{{ $mod->sigla }}</td>
                                            <td>{{ $mod->nombre }} <b> {{ $mod->version }}.{{ $mod->edicion }} </b>
                                            </td>
                                            <td class="td-actions">
                                                <button type="button" rel="tooltip" class="btn btn-danger">
                                                    <i class="material-icons">close</i>
                                                </button>
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
