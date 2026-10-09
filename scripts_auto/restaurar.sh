#!/bin/bash
# RESTAURAR - BD fondo_rotativo_esnace
if [ -z "$1" ]; then echo "Uso: $0 ~/BACKUP_FONDO_ROTATIVO_XXX"; ls -d ~/BACKUP_FONDO_ROTATIVO_* 2>/dev/null; exit 1; fi
BACKUP_DIR=$1
cd /opt/homebrew/var/www/fondo-rotativo-esnace/
echo "🔄 Restaurando $BACKUP_DIR"
SQL=$(ls $BACKUP_DIR/*.sql | head -1)
mysql -u root -p'Ciber.2026' fondo_rotativo_esnace < $SQL
cp -r $BACKUP_DIR/Models/* app/Models/ 2>/dev/null; cp -r $BACKUP_DIR/Controllers/* app/Http/Controllers/ 2>/dev/null; cp -r $BACKUP_DIR/views/* resources/views/ 2>/dev/null
php artisan view:clear; php artisan config:clear
echo "✅ Restaurado"
