<div class="content">
    <div class="container-fluid">
        <div class="form-row">
            <div class="col">
                <div class="form-group label-floating has-success">
                    <input type="text" class="form-control" placeholder="Buscar...." wire:model.lazy="attribute">
                    <span class="form-control-feedback">
                        <i class="material-icons">search</i>
                    </span>
                </div>
            </div>
            <div class="col text-right">
                <a href="{{route('factura.create')}}" class="btn btn-outline-primary btn-white">
                    <b>Agregar Factura</b>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4>Listado de Facturas</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="text-primary text-dark">
                                    <th>#</th>
                                    <th>Factura</th>
                                    <th>Fecha</th>
                                    <th>Monto</th>
                                    <th>Acciones</th>
                                </thead>
                                <tbody>
                                    @foreach ($facturas as $item)
                                        <tr>
                                            <td><b>{{ $item->id }}</b></td>
                                            <td><a href="{{$item->file}}" target="_blank"><b>{{$item->numero}}</b></a></td>
                                            <td><b>{{ $item->fecha }}</b></td>
                                            <td><b>{{ $item->monto }}</b></td><td class="td-actions">
                                                <a href="{{route('factura.edit',$item->id)}}" class="btn btn-primary">
                                                    <span class="material-icons">edit</span>
                                                </a>
                                                <a href="{{route('detalle_factura.index',$item->id)}}" class="btn btn-danger">
                                                    <span class="material-icons">add</span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!---paginacion-->
                    <div class="row">
                        <div class="col">
                           {{--  {{ $facturas->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
