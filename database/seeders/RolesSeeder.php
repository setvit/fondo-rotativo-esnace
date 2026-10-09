<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesSeeder extends Seeder {
    public function run(): void {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        
        $permissions = [
            'crear_comision','editar_comision','eliminar_comision','ver_comisiones',
            'gestionar_pasajeros','subir_cotizaciones','generar_cuadro','aprobar_cuadro','rechazar_cuadro',
            'comprar_pasajes','subir_documentos','liquidar_comision','ver_reportes'
        ];
        
        foreach($permissions as $p) { 
            Permission::firstOrCreate(['name' => $p, 'guard_name' => 'web']); 
        }
        
        $custodio = Role::firstOrCreate(['name' => 'CUSTODIO', 'guard_name' => 'web']);
        $custodio->syncPermissions(['crear_comision','editar_comision','ver_comisiones','gestionar_pasajeros','subir_cotizaciones','generar_cuadro','comprar_pasajes','subir_documentos']);
        
        $jefe = Role::firstOrCreate(['name' => 'JEFE_LOGISTICA', 'guard_name' => 'web']);
        $jefe->syncPermissions(['ver_comisiones','aprobar_cuadro','rechazar_cuadro','ver_reportes','liquidar_comision']);
        
        $consulta = Role::firstOrCreate(['name' => 'CONSULTA', 'guard_name' => 'web']);
        $consulta->syncPermissions(['ver_comisiones','ver_reportes']);
        
        User::where('email','etusa@armada.mil.ec')->first()->syncRoles(['CUSTODIO']);
        User::where('email','logistica.coopna@armada.mil.ec')->first()->syncRoles(['JEFE_LOGISTICA']);
    }
}
