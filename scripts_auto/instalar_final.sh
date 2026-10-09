#!/bin/bash
# INSTALACIÓN FINAL CORREGIDA - BD fondo_rotativo_esnace
set -e
cd /opt/homebrew/var/www/fondo-rotativo-esnace/
echo "📦 Instalando liquidación ESNACE 95.63% - BD fondo_rotativo_esnace"

echo "1️⃣ Migraciones..."
cp database/migrations/*.php database/migrations/ 2>/dev/null || true
cp PAQUETE_FINAL_ESNACE_CORREGIDO_BD_fondo_rotativo_esnace/database/migrations/*.php database/migrations/ 2>/dev/null || true
php artisan migrate --force

echo "2️⃣ Modelos..."
cp PAQUETE_FINAL_ESNACE_CORREGIDO_BD_fondo_rotativo_esnace/app/Models/*.php app/Models/ 2>/dev/null || true
# fallback si está en otro path
cp ../PAQUETE_FINAL_ESNACE_CORREGIDO_BD_fondo_rotativo_esnace/app/Models/*.php app/Models/ 2>/dev/null || true
cp ./app/Models/*.php app/Models/ 2>/dev/null || true

echo "3️⃣ Controlador..."
cp PAQUETE_FINAL_ESNACE_CORREGIDO_BD_fondo_rotativo_esnace/app/Http/Controllers/*.php app/Http/Controllers/ 2>/dev/null || true
cp ../PAQUETE_FINAL_ESNACE_CORREGIDO_BD_fondo_rotativo_esnace/app/Http/Controllers/LiquidacionController.php app/Http/Controllers/ 2>/dev/null || true

echo "4️⃣ Vistas..."
mkdir -p resources/views/liquidaciones
cp PAQUETE_FINAL_ESNACE_CORREGIDO_BD_fondo_rotativo_esnace/resources/views/liquidaciones/*.blade.php resources/views/liquidaciones/ 2>/dev/null || true
cp ../PAQUETE_FINAL_ESNACE_CORREGIDO_BD_fondo_rotativo_esnace/resources/views/liquidaciones/*.blade.php resources/views/liquidaciones/ 2>/dev/null || true

echo "5️⃣ Rutas..."
if ! grep -q "liquidaciones" routes/web.php 2>/dev/null; then
    cat PAQUETE_FINAL_ESNACE_CORREGIDO_BD_fondo_rotativo_esnace/scripts/ROUTES.txt >> routes/web.php 2>/dev/null || true
    cat ../PAQUETE_FINAL_ESNACE_CORREGIDO_BD_fondo_rotativo_esnace/scripts/ROUTES.txt >> routes/web.php 2>/dev/null || true
fi

php artisan view:clear; php artisan config:clear; php artisan route:clear
echo "✅ INSTALADO - Vaya a /liquidaciones"
echo "Luego ejecute: mysql -u root -p'Ciber.2026' fondo_rotativo_esnace < scripts/registrar_cargo_busan_FINAL.sql"
