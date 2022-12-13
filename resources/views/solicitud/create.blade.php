@extends('layouts.app', ['activePage' => 'solicitudes', 'titlePage' => 'Solicitudes'])

@section('content')
    @livewire('tics.solicitudes.lw-create')
@endsection
