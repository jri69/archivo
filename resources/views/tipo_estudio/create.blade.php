@extends('layouts.app', ['activePage' => 'estudio', 'titlePage' => 'Agregar Estudios'])

@section('content')
    @livewire('academico.tipo-estudio.lw-create')
@endsection
