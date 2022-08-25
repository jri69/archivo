@extends('layouts.app', ['activePage' => 'estudiante', 'titlePage' => 'Pago Estudiantes'])

@section('content')
    @livewire('contabilidad.pago-estudiante.lw-index')
@endsection