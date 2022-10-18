<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create(['name' => 'Administrador']);

        //Permisos
        Permission::create(['name' => 'administrador', 'description' => 'Permiso de administrador'])->syncRoles($admin);
        Permission::create(['name' => 'usuario.index', 'description' => 'Gestionar usuarios'])->syncRoles($admin);
        Permission::create(['name' => 'documentos.index', 'description' => 'Gestionar documentos'])->syncRoles($admin);
        Permission::create(['name' => 'roles.index', 'description' => 'Gestionar roles'])->syncRoles($admin);
        Permission::create(['name' => 'area.index', 'description' => 'Gestionar areas'])->syncRoles($admin);
        Permission::create(['name' => 'cargo.index', 'description' => 'Gestionar cargos'])->syncRoles($admin);
        Permission::create(['name' => 'modulo.index', 'description' => 'Gestionar modulos'])->syncRoles($admin);
        Permission::create(['name' => 'requisito.index', 'description' => 'Gestionar requisitos'])->syncRoles($admin);
        Permission::create(['name' => 'estudiante.index', 'description' => 'Gestionar estudiantes'])->syncRoles($admin);
        Permission::create(['name' => 'descuento.index', 'description' => 'Gestionar descuentos'])->syncRoles($admin);
        Permission::create(['name' => 'tipo_pago.index', 'description' => 'Gestionar tipos de pagos'])->syncRoles($admin);
        Permission::create(['name' => 'pago_estudiante.index', 'description' => 'Gestionar pago de estudiantes'])->syncRoles($admin);
        Permission::create(['name' => 'pago.index', 'description' => 'Gestionar pagos'])->syncRoles($admin);
        Permission::create(['name' => 'programa.index', 'description' => 'Gestionar programas'])->syncRoles($admin);
        Permission::create(['name' => 'inventario.index', 'description' => 'Gestionar inventario'])->syncRoles($admin);
        Permission::create(['name' => 'activo.index', 'description' => 'Gestionar activos fijos'])->syncRoles($admin);
        Permission::create(['name' => 'unidad.index', 'description' => 'Gestionar unidad organizacional'])->syncRoles($admin);
        Permission::create(['name' => 'recepcion.index', 'description' => 'Gestionar recepcion de documentos'])->syncRoles($admin);
        Permission::create(['name' => 'movimiento.index', 'description' => 'Gestionar movimiento de la documentacion'])->syncRoles($admin);
        Permission::create(['name' => 'servicio.index', 'description' => 'Gestionar servicios'])->syncRoles($admin);
        Permission::create(['name' => 'pago_servicio.index', 'description' => 'Gestionar pago de servicios'])->syncRoles($admin);
        Permission::create(['name' => 'partida.index', 'description' => 'Gestionar partidas'])->syncRoles($admin);
        Permission::create(['name' => 'presupuesto.index', 'description' => 'Gestionar presupuesto'])->syncRoles($admin);
        Permission::create(['name' => 'contrataciones.index', 'description' => 'Gestionar contrataciones de docentes'])->syncRoles($admin);
        Permission::create(['name' => 'sueldos.index', 'description' => 'Gestionar sueldos'])->syncRoles($admin);
        Permission::create(['name' => 'docentes.index', 'description' => 'Gestionar docentes'])->syncRoles($admin);
        Permission::create(['name' => 'factura.index', 'description' => 'Gestionar facturas'])->syncRoles($admin);

        Permission::create(['name' => 'detalle_factura.index', 'description' => 'Gestionar los detalles de las facturas'])->syncRoles($admin);

        Permission::create(['name' => 'administrativo.index', 'description' => 'Gestionar administrativos'])->syncRoles($admin);
        Permission::create(['name' => 'contratacion.index', 'description' => 'Gestionar contratos de administrativos'])->syncRoles($admin);
    }
}
