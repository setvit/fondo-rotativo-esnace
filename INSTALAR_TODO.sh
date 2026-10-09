#!/bin/bash
# ==========================================
# INSTALADOR TODO EN UNO - ESNACE 95.63%
# BD: fondo_rotativo_esnace | root | Ciber.2026
# TNFG-IG-IF TUSA VITAR
# HACE: backup + instalacion + cargo $350 + verificacion
# ==========================================
set -e
echo "=========================================="
echo "🚀 INSTALADOR TODO EN UNO - ESNACE 95.63%"
echo "BD: fondo_rotativo_esnace"
echo "=========================================="

# Ir a directorio del proyecto (donde se descomprimio)
# El paquete debe estar dentro de /opt/homebrew/var/www/fondo-rotativo-esnace/
cd /opt/homebrew/var/www/fondo-rotativo-esnace/

PKG="PAQUETE_FINAL_LISTO_EJECUTAR"
if [ ! -d "$PKG" ]; then
  PKG=$(ls -d PAQUETE_FINAL* 2>/dev/null | head -1)
fi
echo "📦 Paquete: $PKG"

# 1. BACKUP
FECHA=$(date +%Y%m%d_%H%M%S)
BACKUP_DIR=~/BACKUP_FONDO_ROTATIVO_$FECHA
mkdir -p $BACKUP_DIR
echo ""
echo "1️⃣ BACKUP BD fondo_rotativo_esnace..."
mysqldump -u root -p'Ciber.2026' fondo_rotativo_esnace > $BACKUP_DIR/fondo_rotativo_esnace_$FECHA.sql
echo "✅ Backup OK: $BACKUP_DIR/fondo_rotativo_esnace_$FECHA.sql"
echo "   Respaldo codigo..."
cp -r app/Models $BACKUP_DIR/ 2>/dev/null; cp -r app/Http/Controllers $BACKUP_DIR/ 2>/dev/null; cp -r resources/views $BACKUP_DIR/ 2>/dev/null

# 2. INSTALACION ARCHIVOS
echo ""
echo "2️⃣ Copiando archivos nuevos..."
cp $PKG/database/migrations/*.php database/migrations/
cp $PKG/app/Models/*.php app/Models/
cp $PKG/app/Http/Controllers/LiquidacionController.php app/Http/Controllers/LiquidacionController.php
mkdir -p resources/views/liquidaciones
cp $PKG/resources/views/liquidaciones/*.blade.php resources/views/liquidaciones/

# 3. MIGRACIONES
echo "3️⃣ Migrando..."
php artisan migrate --force

# 4. RUTAS
echo "4️⃣ Rutas..."
if ! grep -q "liquidaciones" routes/web.php; then
  cat $PKG/scripts/ROUTES.txt >> routes/web.php
fi

php artisan view:clear
php artisan config:clear
php artisan route:clear

# 5. CARGO $350 BUSAN
echo ""
echo "5️⃣ Registrando cargo Kiwi $350 BUSAN COM-20260925151104..."
mysql -u root -p'Ciber.2026' fondo_rotativo_esnace < $PKG/scripts/registrar_cargo_busan_FINAL.sql

echo ""
echo "=========================================="
echo "✅ INSTALACION COMPLETA - 95.63%"
echo "=========================================="
mysql -u root -p'Ciber.2026' fondo_rotativo_esnace -e "SELECT monto_asignado, monto_ejecutado, saldo_disponible, porcentaje_ejecutado FROM control_fondo; SELECT codigo, destino, total_valor_pasajes FROM comisiones WHERE codigo='COM-20260925151104';"
echo ""
echo "🌐 http://localhost:8000/liquidaciones"
echo "💾 Backup: $BACKUP_DIR"
echo "Si falla: mysql -u root -p'Ciber.2026' fondo_rotativo_esnace < $BACKUP_DIR/fondo_rotativo_esnace_$FECHA.sql"
