@extends('layouts.app',['activePage' => 'documento', 'titlePage' => 'Agregar Documento'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row" style="margin-left: 10%">
                <div class="col-md-10">
                    <form action="#" method="POST" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <!--<div class="row">
                                <label for="nombre" class="col-sm-2 col-form-label"><b>Codigo:</b></label>
                                <div class="col-sm-7">
                                    <input type="number" class="form-control" name="codigo">
                                </div>
                            </div>
                            <br> -->
                            <div class="row">
                                <label for="nombre" class="col-sm-2 col-form-label"><b>Nombre:</b></label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="nombre">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <label for="nombre" class="col-sm-2 col-form-label"><b>Responsable:</b></label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="responsable">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <label for="nombre" class="col-sm-2 col-form-label"><b>Observacion:</b></label>
                                <div class="col-sm-7">
                                    <textarea class="textarea resize-ta" name="observacion" id="" cols="60" rows="3"  placeholder="Observaciones..."></textarea>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <label for="nombre" class="col-sm-2 col-form-label"><b>Origen:</b></label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="origen">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <label for="nombre" class="col-sm-2 col-form-label"><b>Fecha:</b></label>
                                <div class="col-sm-7">
                                    <input type="date" class="form-control" name="origen">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <label for="nombre" class="col-sm-2 col-form-label"><b>Documento:</b></label>
                                <div class="col-sm-7">
                                    <input type="file" class="form-control" name="doc" placeholder="Seleccione un documento...">
                                </div>
                            </div>
                            <br>
                        </div>
                        <div class="card-footer ml-auto mr-auto">
                            <button type="submit"class="btn btn-primary">
                                <b>Guardar Datos</b>                                 
                            </button>
                            <a href="{{route('documento.index')}}" class="btn btn-primary"><b>Cancelar</b></a>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection