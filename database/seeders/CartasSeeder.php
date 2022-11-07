<?php

namespace Database\Seeders;

use App\Models\TipoCarta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoCarta::create([
            'id' => 1,
            'nombre' => 'Comunicación interna',
            'tipo' => 'Docente',
        ]);
        TipoCarta::create([
            'id' => 2,
            'nombre' => 'Condiciones y términos para la contratación',
            'tipo' => 'Docente',
        ]);
        TipoCarta::create([
            'id' => 3,
            'nombre' => 'Informe de conformidad',
            'tipo' => 'Docente',
        ]);
        TipoCarta::create([
            'id' => 4,
            'nombre' => 'Informe técnico',
            'tipo' => 'Docente',
        ]);
        TipoCarta::create([
            'id' => 5,
            'nombre' => 'Notificación de adjudicación',
            'tipo' => 'Docente',
        ]);
        TipoCarta::create([
            'id' => 6,
            'nombre' => 'Propuesta del consultor',
            'tipo' => 'Docente',
        ]);
        TipoCarta::create([
            'id' => 7,
            'nombre' => 'Requerimiento de propuesta',
            'tipo' => 'Docente',
        ]);
        TipoCarta::create([
            'id' => 8,
            'nombre' => 'Solicitud de contratacion',
            'tipo' => 'Docente',
        ]);
    }
}
