@extends('layouts.app', ['activePage' => 'programa', 'titlePage' => 'Programas'])

@section('content')
    @livewire('academico.programa.lw-edit', ['programa' => $programa])
@endsection
