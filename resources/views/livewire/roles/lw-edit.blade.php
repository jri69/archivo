<div class="content">
    <div class="container-fluid">
        <div class="row" style="margin-left: 10%">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Nombre</label>
                                    <input type="text" class="form-control" name="name" wire:model.defer="name">
                                </div>
                                @error('name')
                                    <span class="error text-danger" for="input-name">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-11">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Permisos</label>
                                </div>
                                <div class="">
                                    @foreach ($permissions as $key => $permission)
                                        <label>
                                            <input wire:model.defer='permisosV.{{ $permission->id }}' type="checkbox"
                                                value="{{ $permission->id }}" class="checkbox">
                                            {{ $permission->description }} &nbsp;
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>

                    <div class="card-footer ml-auto mr-auto">
                        <a class="btn btn-primary text-white" wire:click="add()">
                            <b>Guardar Datos</b>
                        </a>
                        <a href="{{ route('roles.index') }}" class="btn btn-primary"><b>Cancelar</b></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
