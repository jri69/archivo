@extends('layouts.app',['activePage' => 'estudiantes', 'titlePage' => 'Agregar Postgraduante'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row" style="margin-left: 10%">
                <div class="col-md-11">
                    <form action="{{route('pago_estudiante.store')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <label for="nombre" class="col-sm-2 col-form-label"><b>Nombre del Postgraduante:</b></label>
                                <div class="col-sm-7">
                                    <select name="estudiante_id" id="_estudiante" class="form-control">
                                        <option disabled selected>Seleccione el Postgraduante</option>
                                        @foreach ($pago as $estudiante)
                                            <option value="{{$estudiante->id}}">{{$estudiante->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>                            
                            <br>
                            <div class="row">
                                <label for="nombre" class="col-sm-2 col-form-label"><b>Nombre del Descuento:</b></label>
                                <div class="col-sm-7">
                                    <select name="tipo_descuento_id" id="_descuento" class="form-control">
                                        <option disabled selected>Seleccione el Tipo de Descuento</option>
                                        @foreach ($descuentos as $descuento)
                                            <option value="{{$descuento->id}}">{{$descuento->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <label for="modulos" class="col-sm-2 col-form-label"><b>Convalidacion:</b></label>
                                <div class="col-sm-7">
                                    <input type="number" class="form-control"
                                    name="convalidacion"
                                    value="">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ml-auto mr-auto">
                            <button type="submit"class="btn btn-primary">
                                <b>Guardar Datos</b>                                 
                            </button>
                            <a href="{{route('pago_estudiante.index')}}" class="btn btn-primary"><b>Cancelar</b></a>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection