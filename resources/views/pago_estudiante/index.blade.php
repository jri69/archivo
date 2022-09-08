@extends('layouts.app', ['activePage' => 'estudiantes', 'titlePage' => 'Pago Estudiantes'])

@section('content')
    @livewire('contabilidad.pago-estudiante.lw-index')
@endsection