@extends('layouts.app', ['activePage' => 'programa', 'titlePage' => 'Programas'])

@section('content')
    @livewire('academico.programa.lw-inscribir', ['modulo' => $modulo, 'programa' => $programa])
@endsection
