<?php

namespace Database\Seeders;

use App\Models\Contrato;
use App\Models\Docente;
use App\Models\Estudiante;
use App\Models\EstudiantePrograma;
use App\Models\Modulo;
use App\Models\Programa;
use App\Models\ProgramaModulo;
use App\Models\Requisito;
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
            'nombre' => 'Programa de Ingeniería de Sistemas',
            'sigla' => 'PR',
            'version' => 1,
            'edicion' => 2,
            'fecha_inicio' => now(),
            'fecha_finalizacion' => '2022/10/10',
            'cantidad_modulos' => 0,
            'costo' => 30000,
            'tipo' => 'Doctorado',
        ]);
        for ($i = 0; $i < 500; $i++) {
            Programa::create([
                'nombre' => 'Programa ' . $i + 1,
                'sigla' => 'PR',
                'version' => $i,
                'edicion' => $i + 1,
                'fecha_inicio' => now(),
                'fecha_finalizacion' => '2022/10/10',
                'cantidad_modulos' => 0,
                'costo' => 1000 * $i,
                'tipo' => 'Doctorado',
            ]);
        }

        for ($i = 0; $i < 500; $i++) {
            Docente::create([
                'nombre' => 'Docente ' . $i + 1,
                'apellido' => 'Apellido ' . $i + 1,
                'honorifico' => 'Ing.',
                'cedula' => 'V-12345678',
                'correo' => 'docente' . $i + 1 . '@gmail.com',
                'telefono' => '0414-1234567',
                'facturacion' => true,
            ]);
        }

        $modulo1 = Modulo::create([
            'nombre' => 'Modulo 1',
            'sigla' => 'MD',
            'estado' => 'Sin Iniciar',
            'version' => 1,
            'edicion' => 1,
            'costo' => 15000,
            'fecha_inicio' => "2022/08/10",
            'fecha_final' => "2022/09/10",
            'docente_id' => rand(1, 500),
        ]);

        $modulo2 = Modulo::create([
            'nombre' => 'Modulo 2',
            'sigla' => 'MP',
            'estado' => 'Sin Iniciar',
            'version' => 1,
            'edicion' => 1,
            'costo' => 15000,
            'fecha_inicio' => "2022/09/10",
            'fecha_final' => "2022/10/10",
            'docente_id' => rand(1, 500),
        ]);

        ProgramaModulo::create([
            'id_programa' => $programa->id,
            'id_modulo' => $modulo1->id,
        ]);

        ProgramaModulo::create([
            'id_programa' => $programa->id,
            'id_modulo' => $modulo2->id,
        ]);

        for ($i = 0; $i < 500; $i++) {
            $modulo = Modulo::create([
                'nombre' => 'Modulo ' . $i + 10,
                'sigla' => 'PR ' . $i,
                'estado' => 'Sin Iniciar',
                'version' => $i,
                'edicion' => $i + 1,
                'costo' => 150 * $i,
                'fecha_inicio' => "2022/08/10",
                'fecha_final' => "2022/09/10",
                'docente_id' => rand(1, 500),
            ]);

            ProgramaModulo::create([
                'id_programa' => rand(1, 500),
                'id_modulo' => $modulo->id,
            ]);
        }
        for ($i = 0; $i < 500; $i++) {
            Contrato::create([
                'fecha_inicio' => now(),
                'fecha_final' => '2022/12/10',
                'horarios' => 'Lunes 8:00-10:00, Martes 8:00-10:00, Miercoles 8:00-10:00',
                'pagado' => $i % 2 == 0 ? true : false,
                'honorario' => rand(5000, 10000),
                'modulo_id' => rand(1, 500),
            ]);
        }
        $estudiante = Estudiante::create([
            'nombre' => 'Nahuel Zalazar',
            'email' => 'nahu@inegas.com',
            'estado' => 'Activo',
            'telefono' => '256589555',
            'cedula' => '2545845',
            'carrera' => 'Ingenieria Informatica',
            'universidad' => 'UAGRM',
            'expedicion' => 'SC',
        ]);

        EstudiantePrograma::create([
            'id_programa' => $programa->id,
            'id_estudiante' => $estudiante->id,
        ]);

        for ($i = 0; $i < 500; $i++) {
            $name = 'Estudiante ' . $i + 1;
            $estudiante = Estudiante::create([
                'nombre' => $name,
                'email' =>  $name . '@inegas.com',
                'estado' => 'Activo',
                'telefono' => '256589555',
                'cedula' => '2545845' . $i,
                'carrera' => 'Ingenieria Informatica',
                'universidad' => 'UAGRM',
                'expedicion' => 'SC',
            ]);

            EstudiantePrograma::create([
                'id_programa' => rand(1, 500),
                'id_estudiante' => $estudiante->id,
            ]);
        };
        Requisito::create([
            'nombre' => 'Curriculum',
            'importancia' => 'Alto',
        ]);
        Requisito::create([
            'nombre' => 'Fotocopia de carnet',
            'importancia' => 'Alto',
        ]);
        Requisito::create([
            'nombre' => 'Otro',
            'importancia' => 'Bajo',
        ]);
    }
}
