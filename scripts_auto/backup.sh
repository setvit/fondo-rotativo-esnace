#!/bin/bash
# BACKUP AUTOMÁTICO - FONDO ROTATIVO ESNACE - TNFG-IG-IF TUSA VITAR
# Fecha: $(date)
# Antes de instalar liquidación 95.63% + cargo Kiwi $350 BUSAN

set -e
echo "=========================================="
echo "🔒 BACKUP FONDO ROTATIVO - ESNACE"
echo "=========================================="
cd /opt/homebrew/var/www/fondo-rotativo-esnace/

FECHA=$(date +%Y%m%d_%H%M%S)
BACKUP_DIR=~/BACKUP_FONDO_ROTATIVO_$FECHA
mkdir -p $BACKUP_DIR

echo "📁 Directorio backup: $BACKUP_DIR"

# 1. BACKUP BASE DE DATOS
echo "💾 Respaldando Base de Datos..."
if [ -f "database/database.sqlite" ]; then
    cp database/database.sqlite $BACKUP_DIR/database.sqlite
    echo "✅ SQLite respaldado"
else
    # MySQL - pide password
    echo "Ingrese password MySQL (si aplica):"
    read -s DBPASS
    if [ ! -z "$DBPASS" ]; then
        mysqldump -u root -p$DBPASS fondo_rotativo > $BACKUP_DIR/fondo_rotativo_$FECHA.sql 2>/dev/null || mysqldump -u root -p fondo_rotativo > $BACKUP_DIR/fondo_rotativo_$FECHA.sql
    else
        mysqldump -u root -p fondo_rotativo > $BACKUP_DIR/fondo_rotativo_$FECHA.sql
    fi
    echo "✅ MySQL respaldado: $BACKUP_DIR/fondo_rotativo_$FECHA.sql"
fi

# 2. BACKUP CÓDIGO
echo "📂 Respaldando código..."
cp -r app/Models $BACKUP_DIR/Models
cp -r app/Http/Controllers $BACKUP_DIR/Controllers
cp -r resources/views $BACKUP_DIR/views
cp -r database/migrations $BACKUP_DIR/migrations
cp routes/web.php $BACKUP_DIR/web.php 2>/dev/null || true
cp .env $BACKUP_DIR/.env 2>/dev/null || true
echo "✅ Código respaldado"

# 3. BACKUP GIT (si existe)
if [ -d ".git" ]; then
    echo "🔧 Git backup..."
    git status
    git add -A
    git commit -m "BACKUP antes de liquidacion ESNACE 95.63% + cargo Kiwi $350 BUSAN - $FECHA" || echo "Sin cambios para commit"
    git branch backup-antes-liquidacion-$FECHA
    echo "✅ Git branch creada: backup-antes-liquidacion-$FECHA"
fi

# 4. Info actual
echo ""
echo "📊 ESTADO ACTUAL ANTES DE CAMBIOS:"
php artisan tinker --execute="echo 'ControlFondo: '; print_r(\App\Models\ControlFondo::first()->toArray());" 2>/dev/null || echo "No se pudo leer ControlFondo"
echo ""
echo "=========================================="
echo "✅ BACKUP COMPLETADO: $BACKUP_DIR"
echo "=========================================="
echo "Archivos:"
ls -lh $BACKUP_DIR/ | head -20
echo ""
echo "Si algo sale mal, restaurar con:"
echo "  ./scripts_auto/restaurar.sh $BACKUP_DIR"
echo ""
