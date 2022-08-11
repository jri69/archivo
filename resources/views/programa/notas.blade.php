@extends('layouts.app', ['activePage' => 'programa', 'titlePage' => 'Programas'])

@section('content')
    @livewire('academico.programa.lw-notas', ['programa' => $programa, 'modulo' => $modulo, 'estudiante_programa' => $estudiante_programa])
@endsection
