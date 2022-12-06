@extends('layouts.app', ['activePage' => 'estudiante', 'titlePage' => 'Agregar Estudiante'])

@section('content')
    @livewire('academico.estudiante.lw-new-program', ['estudiante' => $estudiante])
@endsection
