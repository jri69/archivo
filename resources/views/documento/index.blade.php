@extends('layouts.app',['activePage' => 'documento', 'titlePage' => 'Documento'])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-left">
                    <a href="{{route('documento.create')}}" class="btn btn-outline-primary btn-white"><b>Agregar Documento</b></a>
                </div>    
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4>Listado de Documentos</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="text-primary text-dark">
                                        <th>Codigo</th>
                                        <th>Nombre</th>
                                        <th>Responsable</th>
                                        <th>Observacion</th>
                                        <th>Origen</th>
                                        <th>Destino</th>
                                        <th>Fecha</th>

                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
        </div>    
    </div>    
@endsection