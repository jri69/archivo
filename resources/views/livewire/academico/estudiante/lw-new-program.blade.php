<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Programas</h4>
                        <p class="card-category">Seleccione un programa y modulo</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Programa</label>
                                    <select class="form-control" wire:model='programa_id' name="id_programa">
                                        <option disabled selected value="">Seleccione un programa</option>
                                        @foreach ($programas as $programa)
                                            <option value="{{ $programa->id }}">{{ $programa->nombre }}</option>
                                        @endforeach
                                    </select>
                                    @error('programa_id')
                                        <span class="error text-danger" for="input-nombre">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Modulo</label>
                                    <select class="form-control" wire:model.defer='modulo_id' name="id_programa">
                                        <option disabled selected value="">Seleccione un modulo</option>
                                        @foreach ($modulos as $modulo)
                                            <option value="{{ $modulo->id }}">{{ $modulo->nombre }}</option>
                                        @endforeach
                                    </select>
                                    @error('modulo_id')
                                        <span class="error text-danger" for="input-nombre">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="card-footer ml-auto mr-auto">
                                <button class="btn btn-primary" wire:click='save()'>Guardar</button>
                                <a href="{{ route('estudiante.show', $estudiante->id) }}"
                                    class="btn btn-primary pull-right">Cancelar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
