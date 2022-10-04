@extends('layouts.app', ['activePage' => 'subpartida', 'titlePage' => 'Agregar Sub Partida'])

@section('content')
    @livewire('partida.partida.create',[])
@endsection
