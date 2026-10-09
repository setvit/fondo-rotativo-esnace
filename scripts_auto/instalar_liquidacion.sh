#!/bin/bash
# INSTALACIÓN AUTOMÁTICA - LIQUIDACIÓN ESNACE 95.63% + CARGO KIWI $350 BUSAN
# TNFG-IG-IF TUSA VITAR EDUARDO

set -e
echo "=========================================="
echo "📦 INSTALANDO LIQUIDACIÓN ESNACE 95.63%"
echo "=========================================="
cd /opt/homebrew/var/www/fondo-rotativo-esnace/

# Verificar backup
if [ ! -d ~/BACKUP_FONDO_ROTATIVO_* ]; then
    echo "⚠️  ADVERTENCIA: No se encontró backup. Ejecute primero ./scripts_auto/backup.sh"
    read -p "¿Continuar sin backup? (s/n): " resp
    if [ "$resp" != "s" ]; then exit 1; fi
fi

echo "1️⃣ Copiando migraciones..."
cp database/migrations/2026_09_28_100000_create_liquidaciones_tables.php /opt/homebrew/var/www/fondo-rotativo-esnace/database/migrations/ 2>/dev/null || cp PAQUETE_LIQUIDACION_ESNACE_FINAL/database/migrations/2026_09_28_100000_create_liquidaciones_tables.php database/migrations/
cp PAQUETE_LIQUIDACION_ESNACE_FINAL/database/migrations/2026_09_28_add_cargo_kiwi_busan.php database/migrations/ 2>/dev/null || echo "Migración cargo ya existe"

echo "2️⃣ Ejecutando migraciones (NO destructivas)..."
php artisan migrate --force

echo "3️⃣ Copiando Modelos..."
cp PAQUETE_LIQUIDACION_ESNACE_FINAL/app/Models/Liquidacion.php app/Models/
cp PAQUETE_LIQUIDACION_ESNACE_FINAL/app/Models/MovimientoFondo.php app/Models/MovimientoFondo.php

echo "4️⃣ Copiando Controlador..."
cp PAQUETE_LIQUIDACION_ESNACE_FINAL/app/Http/Controllers/LiquidacionController.php app/Http/Controllers/

echo "5️⃣ Copiando Vistas..."
mkdir -p resources/views/liquidaciones
cp PAQUETE_LIQUIDACION_ESNACE_FINAL/resources/views/liquidaciones/*.blade.php resources/views/liquidaciones/

echo "6️⃣ Verificando rutas..."
if ! grep -q "liquidaciones" routes/web.php; then
    echo "" >> routes/web.php
    echo "// Liquidación ESNACE - TNFG TUSA" >> routes/web.php
    cat PAQUETE_LIQUIDACION_ESNACE_FINAL/scripts/ROUTES.txt >> routes/web.php
    echo "✅ Rutas agregadas"
else
    echo "ℹ️ Rutas ya existen"
fi

echo "7️⃣ Limpiando cache..."
php artisan view:clear
php artisan config:clear
php artisan route:clear

echo ""
echo "=========================================="
echo "✅ MÓDULO LIQUIDACIÓN INSTALADO"
echo "=========================================="
echo "Ahora registre el cargo adicional Kiwi $350 BUSAN:"
echo "  Opción A - SQL (recomendado si ya tiene 92.13%):"
echo "  mysql -u root -p fondo_rotativo < PAQUETE_LIQUIDACION_ESNACE_FINAL/scripts/registrar_cargo_busan.sql"
echo ""
echo "  Opción B - Tinker:"
echo "  php artisan tinker < PAQUETE_LIQUIDACION_ESNACE_FINAL/scripts/registrar_cargo_busan_350.php"
echo ""
echo "Luego vaya a: http://localhost:8000/liquidaciones"
echo "=========================================="
