<?php

namespace Database\Seeders;

use App\Models\Modulo;
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
        Modulo::create([
            'nombre' => 'Modulo 1',
            'sigla' => 'MO',
            'version' => '1',
            'edicion' => '2',
        ]);
        Modulo::create([
            'nombre' => 'Modulo 2',
            'sigla' => 'MU',
            'version' => '3',
            'edicion' => '2',
        ]);
        Modulo::create([
            'nombre' => 'Modulo 3',
            'sigla' => 'MD',
            'version' => '2',
            'edicion' => '2',
        ]);
        Modulo::create([
            'nombre' => 'Modulo 4',
            'sigla' => 'MA',
            'version' => '1',
            'edicion' => '2',
        ]);
    }
}
