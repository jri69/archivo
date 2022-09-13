<?php

namespace Database\Seeders;

use App\Models\ActivoFijo;
use App\Models\Inventario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class inventarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 40; $i++) {
            Inventario::create([
                'nombre' => 'Articulo' . $i,
                'estado' => 'Bueno',
                'tipo' => 'Articulo',
                'modelo' => 'Modelo' . $i,
                'cantidad' => 10,
                'observaciones' => 'Observaciones' . $i,
            ]);

            ActivoFijo::create([
                'codigo' =>  'AF' . $i,
                'descripcion' => 'Descripcion' . $i,
                'unidad' => 'Unidad' . $i,
                'estado' => 'Bueno',
                'tipo' => 'Articulo',
                'id_usuario' => 1,
                'id_area' => 1,
            ]);
        }
    }
}
