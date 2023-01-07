<?php

namespace Database\Seeders;

use App\Models\Contrato;
use App\Models\Docente;
use App\Models\Estudiante;
use App\Models\EstudianteModulo;
use App\Models\EstudiantePrograma;
use App\Models\Modulo;
use App\Models\NotasPrograma;
use App\Models\Programa;
use App\Models\ProgramaCalendar;
use App\Models\ProgramaModulo;
use App\Models\Prospecto;
use App\Models\Requisito;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Nette\Utils\Random;

class AcademicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipo = ['Doctorado', 'Maestria', 'Especialidad', 'Diplomado', 'Cursos', 'Sin tipo'];
        $modalidad = ['Presencial', 'Virtual'];
        $start = now();
        $end = '2023-12-31';

        Docente::create([
            'nombre' => 'Juan',
            'apellido' => 'Perez',
            'honorifico' => 'Lic',
            'cedula' => '123456789',
            'expedicion' => 'LP',
            'correo' => 'juan@emi.com',
            'telefono' => 23456789,
            'facturacion' => true,
        ]);
        Programa::create([
            'nombre' => "Programa de prueba",
            'codigo' => '123456',
            'sigla' => 'PRUEBA',
            'version' => '1',
            'edicion' => '1',
            'tipo' => $tipo[rand(0, 5)],
            'modalidad' => $modalidad[rand(0, 1)],
            'hrs_academicas' => rand(1, 100),
            'fecha_inicio' => $start,
            'fecha_finalizacion' => $end,
            'cantidad_modulos' => rand(1, 10),
            'costo' => rand(1, 100),
            'has_grafica' => 'Si',
        ]);
        Modulo::create([
            'estado' => 'Activo',
            'hrs_academicas' => rand(1, 100),
            'codigo' => '123456',
            'contenido' => 'Contenido de prueba',
            'nombre' => 'Modulo de prueba',
            'sigla' => 'PRUEBA',
            'version' => '1',
            'edicion' => '1',
            'modalidad' => $modalidad[rand(0, 1)],
            'costo' => rand(1, 100),
            'fecha_inicio' => $start,
            'fecha_final' => $end,
            'docente_id' => 1,
            'programa_id' => 1,
            'cal_docente' => rand(1, 5),
        ]);
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
