@extends('layouts.app',['activePage' => 'Descuento', 'titlePage' => 'Editar Descuento'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{route('descuento.update',$descuento->id)}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Nombre del Descuento:</b> </label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control"
                                        name="nombre"
                                        value="{{old('nombre',$descuento->nombre)}}"
                                        >
                                    </div>
                                </div>
                                <br>   
                                 <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Descuento %:</b> </label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control"
                                        name="monto"
                                        value="{{old('monto',$descuento->monto)}}"
                                        >
                                    </div>
                                </div>                             
                            </div>
                            <div class="card-footer ml-auto mr-auto">
                            <button type="submit"class="btn btn-primary">
                                <b>Guardar Datos</b>                                 
                            </button>
                            <a href="{{route('descuento.index')}}" class="btn btn-primary"><b>Cancelar</b></a>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection