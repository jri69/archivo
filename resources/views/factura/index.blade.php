@extends('layouts.app', ['activePage' => 'factura', 'titlePage' => 'Factura'])

@section('content')
    @livewire('factura.factura.index',[])
@endsection