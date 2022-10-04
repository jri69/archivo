<div class="content">
    <div class="container-fluid">
        <div class="row" style="margin-left: 10%">
            <div class="col-md-11">
                <form action="#" method="post" class="form-horizontal" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <label for="nombre" class="col-sm-2 col-form-label"> <b> Partidas:</b> </label>
                            <div class="col-sm-7">
                                <select wire:model="partida_id" name="second_partida_id" class="form-control">
                                    <option >Seleccione la Second Partida</option>
                                    @foreach ($partidas as $partida)
                                        <option value="{{$partida->id}}">{{$partida->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>                        
                        </div>
                        <br>                            
                        <div class="row">
                            <label for="nombre" class="col-sm-2 col-form-label"> <b> Codigo:</b> </label>
                            <div class="col-sm-7">
                                <input type="number" class="form-control"
                                wire:model="codigo"
                                name="codigo"
                                >
                            </div>                                
                        </div>
                        <br>
                        <div class="row">
                            <label for="nombre" class="col-sm-2 col-form-label"> <b> Nombre:</b> </label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control"
                                wire:model="nombre"
                                name="nombre"
                                >
                            </div>                             
                            <a wire:click="add()" class="btn btn-success btn-fab btn-fab-mini btn-round text-white">
                                <i class="material-icons">add</i>
                            </a>
                        </div>                       
                        
                        
                    </div>
                    <div class="card-footer ml-auto mr-auto">
                        <a wire:click="store()" class="btn btn-primary text-white">
                            <b>Guardar Datos</b>
                        </a>
                        <a href="{{route('t_partida.index')}}" class="btn btn-primary"><b>Cancelar</b></a>
                    </div>
                </div>
            </form>
            </div>
        </div>
        <div class="row" style="margin-left: 10%">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4>Listado de Second Partidas</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Codigo</th>
                                        <th>Nombre</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($listas as $item)
                                        <tr>
                                            <td><b>{{ $item['id'] }}</b></td>
                                            <td><b>{{ $item['codigo'] }}</b></td>
                                            <td><b>{{ $item['nombre'] }}</b></td>                                           
                                            <td class="td-actions">
                                                <a wire:click="del({{ $item['id'] }})" rel="tooltip"
                                                    class="btn btn-danger text-white">
                                                    <i class="material-icons">close</i>
                                                </a>
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
