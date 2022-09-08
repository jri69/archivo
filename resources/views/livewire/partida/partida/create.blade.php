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
                                <select name="partida_id" id="_partida" class="form-control">
                                    <option disabled selected>Seleccione la Partida</option>
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
                                name="codigo"
                                >
                            </div>                                
                        </div>
                        <br>
                        <div class="row">
                            <label for="nombre" class="col-sm-2 col-form-label"> <b> Nombre:</b> </label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control"
                                name="nombre"
                                >
                            </div>  
                           
                            <a wire:click="add({{ $partida->id }})" class="btn btn-success btn-fab btn-fab-mini btn-round text-white">
                                <i class="material-icons">add</i>
                            </a>
                        </div>                       
                        
                        
                    </div>
                    <div class="card-footer ml-auto mr-auto">
                        <button type="submit"class="btn btn-primary">
                            <b>Guardar Datos</b>                                 
                        </button>
                        <a href="{{route('subpartida.index')}}" class="btn btn-primary"><b>Cancelar</b></a>
                    </div>
                </div>
            </form>
            </div>
        </div>
        <div class="row" style="margin-left: 10%">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4>Listado de Sub Partidas</h4>
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
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
