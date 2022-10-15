<?php

namespace App\Http\Livewire\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class LwCreate extends Component
{
    public $name;
    public $permisos = [];
    public $permissions;

    public function mount()
    {
        $this->permissions = Permission::orderBy('name')->get();
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|unique:roles',
        ]);
        $rol = Role::create([
            'name' => $this->name,
            'guard_name' => 'web'
        ]);
        foreach ($this->permisos as $permiso) {
            $rol->givePermissionTo($permiso);
        }
        return redirect()->route('roles.index');
    }

    public function render()
    {
        return view('livewire.roles.lw-create');
    }
}
