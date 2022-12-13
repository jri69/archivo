<?php

namespace App\Http\Livewire\Tics\Solicitudes;

use App\Models\Inventario;
use App\Models\Solicitud;
use App\Models\SolicitudInv;
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
        $solicitud = Solicitud::create([
            'user_id' => auth()->user()->id,
            'estado' => 'Pendiente',
        ]);
        foreach ($this->solicitud as $key => $cantidad) {
            SolicitudInv::create([
                'inventario_id' => $key,
                'solicitud_id' => $solicitud->id,
                'cantidad' => $cantidad,
            ]);
            $equipo = Inventario::find($key);
            $equipo->cantidad -= $cantidad;
            $equipo->save();
        }
        return redirect()->route('inventario.index');
    }

    public function render()
    {
        $equipos = Inventario::where('nombre', 'ILIKE', '%' . $this->attribute . '%')
            ->where('cantidad', '>', 0)
            ->orderBy($this->sort, $this->direction)
            ->paginate(10);
        return view('livewire.tics.solicitudes.lw-create', compact('equipos'));
    }
}
