@extends('layouts.app', ['activePage' => 'detalle_factura', 'titlePage' => 'Agregar Detalle Factura'])

@section('content')
    @livewire('factura.detalle-factura.create',[])
@endsection