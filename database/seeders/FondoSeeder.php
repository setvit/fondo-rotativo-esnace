<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class FondoSeeder extends Seeder {
    public function run(): void {
        User::create([
            'grado' => 'TNFG-IG',
            'nombres' => 'EDUARDO STALIN',
            'apellidos' => 'TUSA VITAR',
            'email' => 'etusa@armada.mil.ec',
            'rol' => 'CUSTODIO',
            'password' => Hash::make('Esnace2026'),
            'activo' => true,
        ]);

        User::create([
            'grado' => 'CPFG-EMS',
            'nombres' => 'MARCHAN',
            'apellidos' => 'APELLIDO',
            'email' => 'logistica.coopna@armada.mil.ec',
            'rol' => 'JEFE_LOGISTICA',
            'password' => Hash::make('Logistica2026'),
            'activo' => true,
        ]);
    }
}
