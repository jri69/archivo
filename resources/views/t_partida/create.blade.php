@extends('layouts.app', ['activePage' => 'thirdpartida', 'titlePage' => 'Agregar Third Partida'])

@section('content')
    @livewire('partida.t-partida.create',[])
@endsection
