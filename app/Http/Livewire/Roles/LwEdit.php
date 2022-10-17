<?php

namespace App\Http\Livewire\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class LwEdit extends Component
{
    public $rol;
    public $name;
    public $permisos;
    public $permisosV = [];
    public $permissions;

    public function mount($id)
    {
        $this->rol = Role::find($id);
        $this->name = $this->rol->name;
        $this->permisos = $this->rol->getAllPermissions()->pluck('id')->toArray();
        foreach ($this->permisos as $permiso) {
            $this->permisosV[$permiso] = $permiso;
        }
        $this->permissions = Permission::orderBy('name')->get();
    }

    public function add()
    {
        $this->validate([
            'name' => 'required',
        ]);
        $this->rol->name = $this->name;
        $this->rol->syncPermissions($this->permisosV);
        $this->rol->save();
        return redirect()->route('roles.index');
    }

    public function render()
    {
        return view('livewire.roles.lw-edit');
    }
}
