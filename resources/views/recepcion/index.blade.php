@extends('layouts.app', ['activePage' => 'recepcion', 'titlePage' => 'Ver Recepciones'])

@section('content')
    @livewire('documentos.recepcion.lw-index')
@endsection
