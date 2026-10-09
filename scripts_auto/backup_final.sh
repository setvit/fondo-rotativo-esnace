#!/bin/bash
# BACKUP FINAL CORREGIDO - BD fondo_rotativo_esnace
# TNFG-IG-IF TUSA VITAR - ESNACE - 2026-10-05
# Credenciales: root / Ciber.2026 / fondo_rotativo_esnace

set -e
cd /opt/homebrew/var/www/fondo-rotativo-esnace/

FECHA=$(date +%Y%m%d_%H%M%S)
BACKUP_DIR=~/BACKUP_FONDO_ROTATIVO_$FECHA
mkdir -p $BACKUP_DIR

echo "=========================================="
echo "🔒 BACKUP FONDO ROTATIVO ESNACE"
echo "BD: fondo_rotativo_esnace | User: root"
echo "=========================================="
echo "📁 $BACKUP_DIR"

echo "💾 Respaldando BD fondo_rotativo_esnace..."
mysqldump -u root -p'Ciber.2026' fondo_rotativo_esnace > $BACKUP_DIR/fondo_rotativo_esnace_$FECHA.sql
echo "✅ BD respaldada"
ls -lh $BACKUP_DIR/*.sql

echo "📂 Respaldando código..."
cp -r app/Models $BACKUP_DIR/Models
cp -r app/Http/Controllers $BACKUP_DIR/Controllers
cp -r resources/views $BACKUP_DIR/views
cp -r database/migrations $BACKUP_DIR/migrations
cp routes/web.php $BACKUP_DIR/web.php 2>/dev/null
cp .env $BACKUP_DIR/.env.backup

git add -A 2>/dev/null; git commit -m "BACKUP $FECHA antes liquidacion 95.63% + cargo Kiwi" 2>/dev/null || true
git branch backup-$FECHA 2>/dev/null || true

echo "✅ BACKUP COMPLETADO: $BACKUP_DIR"
echo "Ejecutado actual:"
php artisan tinker --execute="\$c=\App\Models\ControlFondo::first(); echo 'Ejecutado: $'.\$c->monto_ejecutado.' Saldo: $'.\$c->saldo_disponible.' %: '.\$c->porcentaje_ejecutado;" 2>/dev/null
