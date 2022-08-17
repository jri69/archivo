@extends('layouts.app', ['activePage' => 'activo', 'titlePage' => 'Activos'])

@section('content')
    @livewire('administracion.activos.lw-index')
@endsection
