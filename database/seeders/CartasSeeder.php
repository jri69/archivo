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
        Directivo::create([
            'nombre' => 'Ruben',
            'apellido' => 'Orosco Gomez',
            'honorifico' => 'Lic.',
            'cargo' => 'Jefe ADM. y Financiero',
            'institucion' => 'F.C.E.T.',
            'activo' => true,
        ]);
        Directivo::create([
            'nombre' => 'Fernando Miguel',
            'apellido' => 'Navarro Canaviri',
            'honorifico' => 'M. Sc.',
            'cargo' => 'Coordinador de investigación',
            'institucion' => 'Escuela de Ingeniería - F.C.E.T.',
            'activo' => true,
        ]);

        // Titulacion
        TipoCarta::create([
            'nombre' => 'Informe de cumplimiento de requisitos',
            'tipo' => 'Titulacion',
        ]);
        TipoCarta::create([
            'nombre' => 'Designación de director de trabajo de grado',
            'tipo' => 'Titulacion',
        ]);
        TipoCarta::create([
            'nombre' => 'CAC DT',
            'tipo' => 'Titulacion',
        ]);
        TipoCarta::create([
            'nombre' => 'CAC Informe de cumplimiento de requisitos',
            'tipo' => 'Titulacion',
        ]);
        TipoCarta::create([
            'nombre' => 'CD DT',
            'tipo' => 'Titulacion',
        ]);
        TipoCarta::create([
            'nombre' => 'Invitacion tribunal',
            'tipo' => 'Titulacion',
        ]);
        TipoCarta::create([
            'nombre' => 'Informe de acreditacion DT',
            'tipo' => 'Titulacion',
        ]);
        TipoCarta::create([
            'nombre' => 'Informe de originalidad Perfil',
            'tipo' => 'Titulacion',
        ]);
        TipoCarta::create([
            'nombre' => 'Solicitud homologacion DT',
            'tipo' => 'Titulacion',
        ]);
        TipoCarta::create([
            'nombre' => 'Elaboracion de borrador de tesis',
            'tipo' => 'Titulacion',
        ]);
        TipoCarta::create([
            'nombre' => 'Informe de cumplimiento de requisitos 2',
            'tipo' => 'Titulacion',
        ]);
        TipoCarta::create([
            'nombre' => 'CAC Informe de cumplimiento de requisitos 2',
            'tipo' => 'Titulacion',
        ]);
        TipoCarta::create([
            'nombre' => 'CAC tribunales',
            'tipo' => 'Titulacion',
        ]);
        TipoCarta::create([
            'nombre' => 'CD tribunales',
            'tipo' => 'Titulacion',
        ]);
        TipoCarta::create([
            'nombre' => 'Informe de originalidad',
            'tipo' => 'Titulacion',
        ]);
        TipoCarta::create([
            'nombre' => 'Solicitud de homologacion',
            'tipo' => 'Titulacion',
        ]);
        TipoCarta::create([
            'nombre' => 'Invitacion a tribunales',
            'tipo' => 'Titulacion',
        ]);
        TipoCarta::create([
            'nombre' => 'Predefensa',
            'tipo' => 'Titulacion',
        ]);
        TipoCarta::create([
            'nombre' => 'Empastado',
            'tipo' => 'Titulacion',
        ]);
        TipoCarta::create([
            'nombre' => 'Informe de lineas de investigación',
            'tipo' => 'Titulacion',
        ]);
        TipoCarta::create([
            'nombre' => 'Solicitud fecha defensa',
            'tipo' => 'Titulacion',
        ]);
        TipoCarta::create([
            'nombre' => 'Programacion fecha defensa',
            'tipo' => 'Titulacion',
        ]);
        TipoCarta::create([
            'nombre' => 'Conformidad de trabajo',
            'tipo' => 'Titulacion',
        ]);
        TipoCarta::create([
            'nombre' => 'Solicitud de pago',
            'tipo' => 'Titulacion',
        ]);


        // borrables
        TipoCarta::create([
            'nombre' => 'CAC tutor',
            'tipo' => 'Titulacion',
        ]);
        TipoCarta::create([
            'nombre' => 'Informe de cumplimiento de requisitos',
            'tipo' => 'Titulacion',
        ]);
        TipoCarta::create([
            'nombre' => 'Consejo directivo de postgrado',
            'tipo' => 'Titulacion',
        ]);
        TipoCarta::create([
            'nombre' => 'Informe de cumplimiento de requisitos 2',
            'tipo' => 'Titulacion',
        ]);
        TipoCarta::create([
            'nombre' => 'CAC Informe de cumplimiento de requisitos 2',
            'tipo' => 'Titulacion',
        ]);
        TipoCarta::create([
            'nombre' => 'CAC tribunal',
            'tipo' => 'Titulacion',
        ]);
        TipoCarta::create([
            'nombre' => 'CD tribunal',
            'tipo' => 'Titulacion',
        ]);
        TipoCarta::create([
            'nombre' => 'Predefensa',
            'tipo' => 'Titulacion',
        ]);
        TipoCarta::create([
            'nombre' => 'Empastado',
            'tipo' => 'Titulacion',
        ]);
        TipoCarta::create([
            'nombre' => 'Informe de lineas de investigación',
            'tipo' => 'Titulacion',
        ]);
    }
}
