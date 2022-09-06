@extends('layouts.app', ['activePage' => 'movimientos', 'titlePage' => 'Ver Recepciones'])

@section('content')
    @livewire('documentos.movimiento.lw-create', ['recepcion' => $recepcion])
@endsection
