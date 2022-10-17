<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    // Ver los roles
    public function index()
    {
        return view('roles.index');
    }

    // Interface para editar un rol
    public function edit($id)
    {
        return view('roles.edit', compact('id'));
    }

    // Interface para crear un rol
    public function create()
    {
        return view('roles.create');
    }

    // Eliminar un rol
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->route('roles.index');
    }
}
