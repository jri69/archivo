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
    public $administrativos = [];
    public $contables = [];
    public $academico = [];

    public function mount($id)
    {
        $this->rol = Role::find($id);
        $this->name = $this->rol->name;
        $this->permisos = $this->rol->getAllPermissions();
        foreach ($this->permisos as $permiso) {
            switch ($permiso->type) {
                case 'Administrativo':
                    array_push($this->administrativos, $permiso);
                    $this->permisosV[$permiso->id] = $permiso->id;
                    break;
                case 'Contabilidad':
                    array_push($this->contables, $permiso);
                    $this->permisosV[$permiso->id] = $permiso->id;
                    break;
                case 'Académico':
                    array_push($this->academico, $permiso);
                    $this->permisosV[$permiso->id] = $permiso->id;
                    break;
                default:
                    break;
            }
        }
        $permisos = Permission::orderBy('name')->get();
        foreach ($permisos as $permiso) {
            switch ($permiso->type) {
                case 'Administrativo':
                    array_push($this->administrativos, $permiso);
                    break;
                case 'Contabilidad':
                    array_push($this->contables, $permiso);
                    break;
                case 'Académico':
                    array_push($this->academico, $permiso);
                    break;
                default:
                    break;
            }
        }
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
