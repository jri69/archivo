@extends('layouts.app', ['activePage' => 'estudio', 'titlePage' => 'Agregar Estudios'])

@section('content')
    @livewire('academico.tipo-estudio.lw-edit', ['tipos_estudios' => $tipos_estudios])
@endsection
