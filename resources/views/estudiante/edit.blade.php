@extends('layouts.app', ['activePage' => 'estudiante', 'titlePage' => 'Agregar Estudiante'])

@section('content')
    @livewire('academico.estudiante.lw-edit', ['id_estudiante' => $id_estudiante])
@endsection
