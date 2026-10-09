<?php
// diagnostico_comisiones.php - Ver estructura real de BD y vistas
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

echo "=== 1. TABLAS EXISTENTES ===\n";
$tables = DB::select('SHOW TABLES');
foreach($tables as $t){
    $vals = array_values((array)$t);
    echo $vals[0]."\n";
}

echo "\n=== 2. ESTRUCTURA COMISIONES ===\n";
if(Schema::hasTable('comisiones')){
    $cols = DB::select('DESCRIBE comisiones');
    foreach($cols as $c){
        echo "{$c->Field} | {$c->Type} | {$c->Null} | {$c->Key} | {$c->Default}\n";
    }
} else {
    echo "Tabla comisiones no existe\n";
}

echo "\n=== 3. ESTRUCTURA PASAJEROS ===\n";
if(Schema::hasTable('pasajeros')){
    $cols = DB::select('DESCRIBE pasajeros');
    foreach($cols as $c){
        echo "{$c->Field} | {$c->Type}\n";
    }
}

echo "\n=== 4. ESTRUCTURA COTIZACIONES ===\n";
if(Schema::hasTable('cotizaciones')){
    $cols = DB::select('DESCRIBE cotizaciones');
    foreach($cols as $c){
        echo "{$c->Field} | {$c->Type}\n";
    }
}

echo "\n=== 5. ESTRUCTURA PASAJES_COMPRADOS ===\n";
if(Schema::hasTable('pasajes_comprados')){
    $cols = DB::select('DESCRIBE pasajes_comprados');
    foreach($cols as $c){
        echo "{$c->Field} | {$c->Type}\n";
    }
}

echo "\n=== 6. MIGRACIONES COMISIONES ===\n";
$migrations = glob(__DIR__.'/database/migrations/*comision*.php');
foreach($migrations as $m){
    echo "Archivo: $m\n";
}

echo "\n=== 7. MODELO Comision ===\n";
$modelPath = __DIR__.'/app/Models/Comision.php';
if(file_exists($modelPath)){
    echo file_get_contents($modelPath);
}

echo "\n=== 8. RUTAS COMISIONES ===\n";
