@extends('layouts.app', ['activePage' => 'roles', 'titlePage' => 'Editar Roles'])

@section('content')
    @livewire('roles.lw-edit', ['id' => $id])
@endsection
