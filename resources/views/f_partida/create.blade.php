@extends('layouts.app', ['activePage' => 'fifthpartida', 'titlePage' => 'Agregar Quinta Partida'])

@section('content')
    @livewire('partida.f-partida.create',[])
@endsection
