@extends('layouts.app', ['activePage' => 'contrataciones', 'titlePage' => 'Contrataciones'])
@section('content')
    @livewire('contrataciones.contrataciones.lw-create', ['docente' => $docente])
@endsection
