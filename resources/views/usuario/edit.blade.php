@extends('layouts.app',['activePage' => 'usuario', 'titlePage' => 'Editar Usuario'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form action="#" method="post" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control"
                                        name="nombre">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label">Usuario</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control"
                                        name="Apellido">
                                    </div>
                                </div>
                                <br>
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection