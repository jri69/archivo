@extends('layouts.app',['activePage' => 'Metodo de Pago', 'titlePage' => 'Agregar Metodo de Pago'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row" style="margin-left: 10%">
                <div class="col-md-11">
                    <form action="#" method="post" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Metodo de Pago:</b> </label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control"
                                        name="nombre"
                                        >
                                    </div>                                
                                </div>
                                <br>                                
                            </div>
                            <div class="card-footer ml-auto mr-auto">
                            <button type="submit"class="btn btn-primary">
                                <b>Guardar Datos</b>                                 
                            </button>
                            <a href="{{route('tipo_pago.index')}}" class="btn btn-primary"><b>Cancelar</b></a>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection