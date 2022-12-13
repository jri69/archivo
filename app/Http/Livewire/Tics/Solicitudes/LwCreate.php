<?php

namespace App\Http\Livewire\Tics\Solicitudes;

use App\Models\Inventario;
use App\Models\Solicitud;
use Livewire\Component;

class LwCreate extends Component
{
    public $solicitud = [];
    public $casa;
    public $errorValidation = false;
    public $idError;
    public $mensaje;
    public $attribute = '';
    public $type = 'nombre';
    public $sort = 'id';
    public $direction = 'desc';

    public function save()
    {
        $this->errorValidation = false;
        foreach ($this->solicitud as $key => $value) {
            $equipo = Inventario::find($key);
            if (!is_numeric($value) || $value < 0 || $value > $equipo->cantidad) {
                $this->errorValidation = true;
                $this->idError = $key;
                $this->mensaje = "La cantidad debe ser entre 1 y " . $equipo->cantidad;
                return;
            }
        }
        foreach ($this->solicitud as $key => $cantidad) {
            Solicitud::create([
                'tic_id' => $key,
                'user_id' => auth()->user()->id,
                'estado' => 'Pendiente',
                'cantidad' => $cantidad,
            ]);
        }
        return redirect()->route('programa.modulo', [$this->programa, $this->modulo]);
    }

    public function render()
    {
        $equipos = Inventario::where('nombre', 'like', '%' . $this->attribute . '%')->orderBy($this->sort, $this->direction)->paginate(10);
        return view('livewire.tics.solicitudes.lw-create', compact('equipos'));
    }
}
