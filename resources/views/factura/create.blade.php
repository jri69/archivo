@extends('layouts.app', ['activePage' => 'factura', 'titlePage' => 'Agregar Factura'])

@section('content')
    @livewire('factura.factura.create',[])
@endsection