@extends('layouts.app',['activePage' => 'detalle_factura', 'titlePage' => 'Editar Detalle Factura'])

@section('content')
@livewire('factura.detalle-factura.edit', ['id_factura' => $id,'detalle'=>$detalle])
@endsection
