<?php

namespace Database\Seeders;

use App\Models\Directivo;
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
            'nombre' => 'Solicitud de contratacion',
            'tipo' => 'Docente',
        ]);
        TipoCarta::create([
            'nombre' => 'Condiciones y términos para la contratación',
            'tipo' => 'Docente',
        ]);
        TipoCarta::create([
            'nombre' => 'Requerimiento de propuesta',
            'tipo' => 'Docente',
        ]);
        TipoCarta::create([
            'nombre' => 'Propuesta del consultor',
            'tipo' => 'Docente',
        ]);
        TipoCarta::create([
            'nombre' => 'Informe técnico',
            'tipo' => 'Docente',
        ]);
        TipoCarta::create([
            'nombre' => 'Notificación de adjudicación',
            'tipo' => 'Docente',
        ]);
        TipoCarta::create([
            'nombre' => 'Comunicación interna',
            'tipo' => 'Docente',
        ]);
        TipoCarta::create([
            'nombre' => 'Informe de conformidad',
            'tipo' => 'Docente',
        ]);
        TipoCarta::create([
            'nombre' => 'Planilla de pago',
            'tipo' => 'Docente',
        ]);

        Directivo::create([
            'nombre' => 'Erick Rojas',
            'apellido' => 'Balcazar',
            'honorifico' => 'M.Sc.',
            'cargo' => 'Director',
            'institucion' => 'Escuela de Ingeniería - F.C.E.T.',
            'activo' => true,
        ]);
        Directivo::create([
            'nombre' => 'Daniel',
            'apellido' => 'Tejerina Claudio',
            'honorifico' => 'M.Sc.',
            'cargo' => 'Coordinador Académico',
            'institucion' => 'Escuela de Ingeniería - UAGRM',
            'activo' => true,
        ]);
        Directivo::create([
            'nombre' => 'Rene',
            'apellido' => 'Menacho',
            'honorifico' => 'Abog.',
            'cargo' => 'Asesor Legal',
            'institucion' => 'F.C.E.T. - UAGRM',
            'activo' => true,
        ]);
        Directivo::create([
            'nombre' => 'Ruben',
            'apellido' => 'Orozco',
            'honorifico' => 'Lic.',
            'cargo' => 'Responsable del proceso de contratación',
            'institucion' => 'JAF',
            'activo' => true,
        ]);
        Directivo::create([
            'nombre' => 'Orlando',
            'apellido' => 'Pedraza Merida',
            'honorifico' => 'Ph.D.',
            'cargo' => 'Decano',
            'institucion' => 'F.C.E.T.',
            'activo' => true,
        ]);
    }
}
