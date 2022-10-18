<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\Cargo;
use App\Models\User;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $area = Area::create([
            'nombre' => 'Administración',
        ]);
        $cargo = Cargo::create([
            'nombre' => 'Administrador',
        ]);
        $usuario = Usuario::create([
            'nombre' => 'Administrador',
            'apellido' => 'Administrador',
            'area_id' => $area->id,
            'cargo_id' => $cargo->id,
            'ci' => '00000001',
        ]);

        $user = User::create([
            'name' => 'Administrador',
            'email' => 'desarrollo@ei-uagrm.edu.bo',
            'email_verified_at' => now(),
            'password' => Hash::make('secret2022'),
            'usuario_id' => $usuario->id,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $user->assignRole('Administrador');
    }
}
