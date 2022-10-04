@extends('layouts.app', ['activePage' => 'quarterpartida', 'titlePage' => 'Agregar Quarter Partida'])

@section('content')
    @livewire('partida.c-partida.create',[])
@endsection
