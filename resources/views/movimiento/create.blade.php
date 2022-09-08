@extends('layouts.app', ['activePage' => 'movimientos', 'titlePage' => 'Crear Movimiento'])

@section('content')
    @livewire('documentos.movimiento.lw-create', ['recepcion' => $recepcion])
@endsection
