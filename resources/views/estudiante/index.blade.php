@extends('layouts.app', ['activePage' => 'estudiante', 'titlePage' => 'Estudiantes'])

@section('content')
    @livewire('academico.estudiante.lw-index')
@endsection
