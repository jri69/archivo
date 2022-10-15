<?php

namespace App\Http\Livewire\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Livewire\WithPagination;

class LwIndex extends Component
{
    use WithPagination;
    public $pagination = 20;
    public $attribute = '';
    public $type = 'id';
    public $sort = 'id';
    public $direction = 'asc';

    //paginacion bootstrap
    protected $paginationTheme = 'bootstrap';

    //Metodo de reinicio de buscador
    public function updatingAttribute()
    {
        $this->resetPage();
    }
    
    public function render()
    {
        $roles = Role::where('name', 'ILIKE', '%' . $this->attribute . '%')
            ->orderBy('id', 'desc')
            ->paginate(20);
        return view('livewire.roles.lw-index', compact('roles'));
    }
}
