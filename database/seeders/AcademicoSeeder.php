<?php

namespace Database\Seeders;

use App\Models\Estudiante;
use App\Models\EstudiantePrograma;
use App\Models\Modulo;
use App\Models\Programa;
use App\Models\ProgramaModulo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AcademicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $programa = Programa::create([
            'nombre' => 'Programa 1',
            'sigla' => 'PR',
            'version' => 1,
            'edicion' => 2,
            'fecha_inicio' => now(),
            'fecha_finalizacion' => '2022/10/10',
            'cantidad_modulos' => 0,
            'costo' => 30000
        ]);

        $modulo1 = Modulo::create([
            'nombre' => 'Modulo 1',
            'sigla' => 'MD',
            'estado' => 'Sin Iniciar',
            'version' => 1,
            'edicion' => 1,
        ]);

        $modulo2 = Modulo::create([
            'nombre' => 'Modulo 2',
            'sigla' => 'MP',
            'estado' => 'Sin Iniciar',
            'version' => 1,
            'edicion' => 1,
        ]);

        ProgramaModulo::create([
            'id_programa' => $programa->id,
            'id_modulo' => $modulo1->id,
        ]);

        ProgramaModulo::create([
            'id_programa' => $programa->id,
            'id_modulo' => $modulo2->id,
        ]);

        $estudiante = Estudiante::create([
            'nombre' => 'Nahuel Zalazar',
            'email' => 'nahu@inegas.com',
            'estado' => 'Activo',
            'telefono' => '256589555',
            'cedula' => '2545845',
            'carrera' => 'Ingenieria Informatica',
            'universidad' => 'UAGRM'
        ]);

        EstudiantePrograma::create([
            'id_programa' => $programa->id,
            'id_estudiante' => $estudiante->id,
        ]);
    }
}
